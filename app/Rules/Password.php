<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class Password implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Minimum length
        if (strlen($value) < 8) {
            $fail('Password must be at least 8 characters long.');
        }

        // Uppercase letter check
        if (!preg_match('/[A-Z]/', $value)) {
            $fail('Password must contain at least one uppercase letter.');
        }

        // Lowercase letter check
        if (!preg_match('/[a-z]/', $value)) {
            $fail('Password must contain at least one lowercase letter.');
        }

        // Number check
        if (!preg_match('/[0-9]/', $value)) {
            $fail('Password must contain at least one number.');
        }

        // Special character check
        if (!preg_match('/[\W]/', $value)) {
            $fail('Password must contain at least one special character.');
        }

        // Spaces not allowed
        if (Str::contains($value, ' ')) {
            $fail('Password must not contain spaces.');
        }
    }
}