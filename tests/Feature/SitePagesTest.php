<?php

use Inertia\Testing\AssertableInertia as Assert;

test('public site pages render', function (string $route, string $component) {
    $this->get(route($route))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component($component));
})->with([
    ['home', 'site/Home'],
    ['products', 'site/Products'],
    ['services', 'site/Services'],
    ['projects', 'site/Projects'],
    ['about', 'site/About'],
    ['contacts', 'site/Contacts'],
]);

test('contacts page provides the turnstile site key and a form token', function () {
    config(['services.turnstile.site_key' => 'test-site-key']);

    $this->get(route('contacts'))
        ->assertInertia(fn (Assert $page) => $page
            ->component('site/Contacts')
            ->where('turnstileSiteKey', 'test-site-key')
            ->has('formToken'));
});
