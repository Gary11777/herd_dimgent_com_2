<?php

use App\Http\Middleware\ProtectAgainstSpam;
use App\Mail\ContactMessage;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    Mail::fake();

    config([
        'services.turnstile.secret_key' => 'test-secret',
        'services.contact.recipient' => 'info@dimgent.com',
    ]);

    $this->turnstileResponse = ['success' => true];

    Http::fake([
        'challenges.cloudflare.com/*' => fn () => Http::response($this->turnstileResponse),
    ]);
});

function contactPayload(array $overrides = []): array
{
    return array_merge([
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'phone' => '+375 29 123-45-67',
        'company' => 'Acme Ltd',
        'subject' => 'New sensor device',
        'message' => 'We would like to develop a wireless sensor module.',
        'website' => '',
        'form_token' => ProtectAgainstSpam::issueToken(),
        'turnstile_token' => 'valid-token',
    ], $overrides);
}

function submitContact(array $overrides = [])
{
    $payload = contactPayload($overrides);

    test()->travel(ProtectAgainstSpam::MIN_SECONDS + 1)->seconds();

    return test()->from(route('contacts'))->post(route('contacts.store'), $payload);
}

test('a valid submission sends the contact email', function () {
    submitContact()
        ->assertRedirect(route('contacts'))
        ->assertSessionHasNoErrors();

    Mail::assertSent(ContactMessage::class, function (ContactMessage $mail) {
        return $mail->hasTo('info@dimgent.com')
            && $mail->hasReplyTo('jane@example.com', 'Jane Doe')
            && $mail->messageSubject === 'New sensor device';
    });

    Http::assertSent(fn (Request $request) => $request['secret'] === 'test-secret'
        && $request['response'] === 'valid-token');
});

test('the email renders the submitted details', function () {
    $mail = new ContactMessage(
        senderName: 'Jane <b>Doe</b>',
        senderEmail: 'jane@example.com',
        messageSubject: 'Hello',
        body: 'Line one',
    );

    $mail->assertSeeInHtml('Jane &lt;b&gt;Doe&lt;/b&gt;', false);
    $mail->assertSeeInText('Line one');
});

test('input is sanitized before validation', function () {
    submitContact([
        'name' => "  Jane\r\nBcc: spam@example.com  <script>x</script>",
        'email' => ' JANE@Example.com ',
        'subject' => "Hello\nthere",
        'message' => "<b>Bold</b> text\r\n\r\n\r\n\r\nwith gaps",
    ])->assertSessionHasNoErrors();

    Mail::assertSent(ContactMessage::class, function (ContactMessage $mail) {
        return $mail->senderName === 'Jane Bcc: spam@example.com x'
            && $mail->senderEmail === 'jane@example.com'
            && $mail->messageSubject === 'Hello there'
            && $mail->body === "Bold text\n\nwith gaps";
    });
});

test('required fields are validated', function () {
    submitContact([
        'name' => '',
        'email' => 'not-an-email',
        'subject' => '',
        'message' => 'short',
        'phone' => 'call me maybe',
    ])->assertSessionHasErrors(['name', 'email', 'subject', 'message', 'phone']);

    Mail::assertNothingSent();
});

test('turnstile is not called when other fields are invalid', function () {
    submitContact(['email' => 'invalid'])->assertSessionHasErrors('email');

    Http::assertNothingSent();
});

test('a missing turnstile token is rejected', function () {
    submitContact(['turnstile_token' => ''])->assertSessionHasErrors('turnstile_token');

    Mail::assertNothingSent();
});

test('a failed turnstile verification is rejected', function () {
    $this->turnstileResponse = [
        'success' => false,
        'error-codes' => ['invalid-input-response'],
    ];

    submitContact()->assertSessionHasErrors('turnstile_token');

    Mail::assertNothingSent();
});

test('submissions are rejected when turnstile is not configured', function () {
    config(['services.turnstile.secret_key' => null]);

    submitContact()->assertSessionHasErrors('turnstile_token');

    Mail::assertNothingSent();
});

test('a filled honeypot silently discards the submission', function () {
    submitContact(['website' => 'https://spam.example'])
        ->assertRedirect(route('contacts'))
        ->assertSessionHasNoErrors();

    Mail::assertNothingSent();
    Http::assertNothingSent();
});

test('submissions faster than a human are discarded', function () {
    $this->from(route('contacts'))
        ->post(route('contacts.store'), contactPayload())
        ->assertRedirect(route('contacts'));

    Mail::assertNothingSent();
});

test('a tampered form token is discarded', function () {
    submitContact(['form_token' => 'tampered'])->assertSessionHasNoErrors();

    Mail::assertNothingSent();
});

test('submissions are rate limited per ip', function () {
    foreach (range(1, 3) as $attempt) {
        submitContact()->assertSessionHasNoErrors();
    }

    submitContact()->assertSessionHasErrors('form');

    Mail::assertSentCount(3);
});

test('mail transport failures are reported to the user', function () {
    Mail::shouldReceive('to->send')->andThrow(new RuntimeException('sendmail failed'));

    submitContact()->assertSessionHasErrors('form');
});

test('the contact route is protected by csrf, throttling and the honeypot', function () {
    $middleware = app('router')->getRoutes()->getByName('contacts.store')->gatherMiddleware();

    expect($middleware)
        ->toContain('web')
        ->toContain('throttle:contact')
        ->toContain(ProtectAgainstSpam::class);
});
