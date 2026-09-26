<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Honeypot protection for public forms.
 *
 * Rejects submissions that fill the hidden honeypot field or that arrive
 * faster than a human could plausibly type. Bots receive a fake success
 * response so they have no signal to adapt to.
 */
class ProtectAgainstSpam
{
    public const HONEYPOT_FIELD = 'website';

    public const TIMESTAMP_FIELD = 'form_token';

    public const MIN_SECONDS = 3;

    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isSpam($request)) {
            Log::notice('Contact form submission blocked by honeypot.', ['ip' => $request->ip()]);

            return back();
        }

        return $next($request);
    }

    public static function issueToken(): string
    {
        return Crypt::encryptString((string) now()->getTimestamp());
    }

    protected function isSpam(Request $request): bool
    {
        if (filled($request->input(self::HONEYPOT_FIELD))) {
            return true;
        }

        try {
            $issuedAt = (int) Crypt::decryptString((string) $request->input(self::TIMESTAMP_FIELD));
        } catch (DecryptException) {
            return true;
        }

        return now()->getTimestamp() - $issuedAt < self::MIN_SECONDS;
    }
}
