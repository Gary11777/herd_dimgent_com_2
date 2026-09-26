<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ProtectAgainstSpam;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class ContactController extends Controller
{
    public function show(): Response
    {
        return Inertia::render('site/Contacts', [
            'turnstileSiteKey' => config('services.turnstile.site_key'),
            'formToken' => ProtectAgainstSpam::issueToken(),
        ]);
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        $data = $request->validated();

        try {
            Mail::to(config('services.contact.recipient'))->send(new ContactMessage(
                senderName: $data['name'],
                senderEmail: $data['email'],
                messageSubject: $data['subject'],
                body: $data['message'],
                phone: $data['phone'] ?? null,
                company: $data['company'] ?? null,
                ipAddress: $request->ip(),
            ));
        } catch (Throwable $e) {
            report($e);

            return back()->withErrors([
                'form' => 'Sorry, we could not send your message right now. Please try again later or email us directly.',
            ]);
        }

        return back();
    }
}
