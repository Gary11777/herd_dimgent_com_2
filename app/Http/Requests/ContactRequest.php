<?php

namespace App\Http\Requests;

use App\Services\Turnstile;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'string', 'email:rfc,strict', 'max:254'],
            'phone' => ['nullable', 'string', 'max:40', 'regex:/^[0-9+()\-.\s]{5,40}$/'],
            'company' => ['nullable', 'string', 'max:150'],
            'subject' => ['required', 'string', 'min:3', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'turnstile_token' => ['required', 'string', 'max:2048'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'phone.regex' => 'Please enter a valid phone number.',
            'turnstile_token.required' => 'The security check could not be completed. Please try again.',
        ];
    }

    /**
     * Verify Turnstile only once the rest of the input is valid, so that
     * Cloudflare is not called for submissions that would fail anyway.
     *
     * @return array<int, callable>
     */
    public function after(Turnstile $turnstile): array
    {
        return [
            function (Validator $validator) use ($turnstile): void {
                if ($validator->errors()->isNotEmpty()) {
                    return;
                }

                if (! $turnstile->verify($this->input('turnstile_token'), $this->ip())) {
                    $validator->errors()->add(
                        'turnstile_token',
                        'The security check failed. Please refresh the page and try again.',
                    );
                }
            },
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->singleLine('name'),
            'email' => mb_strtolower((string) preg_replace('/\s+/u', '', $this->singleLine('email') ?? '')) ?: null,
            'phone' => $this->singleLine('phone'),
            'company' => $this->singleLine('company'),
            'subject' => $this->singleLine('subject'),
            'message' => $this->multiLine('message'),
        ]);
    }

    /**
     * Strip tags, control characters and line breaks (header injection)
     * and collapse runs of whitespace.
     */
    protected function singleLine(string $key): ?string
    {
        $value = $this->input($key);

        if (! is_string($value)) {
            return null;
        }

        $value = strip_tags($value);
        $value = (string) preg_replace('/[\p{C}]+/u', ' ', $value);
        $value = trim((string) preg_replace('/\s+/u', ' ', $value));

        return $value === '' ? null : $value;
    }

    /**
     * Strip tags and control characters while preserving line breaks.
     */
    protected function multiLine(string $key): ?string
    {
        $value = $this->input($key);

        if (! is_string($value)) {
            return null;
        }

        $value = strip_tags(str_replace(["\r\n", "\r"], "\n", $value));
        $value = (string) preg_replace('/[^\P{C}\n\t]+/u', '', $value);
        $value = (string) preg_replace('/[ \t]+/u', ' ', $value);
        $value = trim((string) preg_replace('/\n{3,}/u', "\n\n", $value));

        return $value === '' ? null : $value;
    }
}
