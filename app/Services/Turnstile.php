<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Turnstile
{
    /**
     * Verify a Cloudflare Turnstile token against the siteverify API.
     */
    public function verify(?string $token, ?string $remoteIp = null): bool
    {
        $secret = config('services.turnstile.secret_key');

        if (blank($secret) || blank($token)) {
            return false;
        }

        try {
            $response = Http::asForm()
                ->timeout(5)
                ->retry(2, 250, throw: false)
                ->post(config('services.turnstile.verify_url'), array_filter([
                    'secret' => $secret,
                    'response' => $token,
                    'remoteip' => $remoteIp,
                ]));
        } catch (ConnectionException $e) {
            Log::warning('Turnstile verification request failed.', ['error' => $e->getMessage()]);

            return false;
        }

        if (! $response->successful() || $response->json('success') !== true) {
            Log::info('Turnstile verification rejected.', [
                'errors' => $response->json('error-codes', []),
            ]);

            return false;
        }

        return true;
    }
}
