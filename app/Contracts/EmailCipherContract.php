<?php

namespace App\Contracts;

use App\Data\EncryptedEmailData;

interface EmailCipherContract
{
    public function encrypt(string $email): EncryptedEmailData;

    public function decrypt(string $username, string $domain): string;
}
