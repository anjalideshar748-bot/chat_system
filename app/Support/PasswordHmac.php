<?php

namespace App\Support;

class PasswordHmac
{
    public static function transform(string $password): string
    {
        return hash_hmac('sha256', $password, self::key());
    }

    protected static function key(): string
    {
        return (string) (config('auth.password_hmac_key') ?? config('app.key') ?? '');
    }
}
