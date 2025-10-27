<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class Turnstile implements Rule
{
    public function passes($attribute, $value)
    {
        if (empty($value)) {
            return false;
        }

        try {
            $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret' => config('turnstile.secret_key'),
                'response' => $value,
                'remoteip' => request()->ip()
            ]);

            $result = $response->json();
            
            return $result['success'] ?? false;
            
        } catch (\Exception $e) {
            return false;
        }
    }

    public function message()
    {
        return 'Falha na verificação de segurança. Por favor, tente novamente.';
    }
}