<?php

namespace App\Services;

use App\Contracts\EmailCipherContract;
use App\Data\EncryptedEmailData;
use Illuminate\Support\Facades\Crypt;

class EmailCipher implements EmailCipherContract
{
    public function encrypt(string $email): EncryptedEmailData
    {
        list($username, $domain) = explode('@', $email);

        return EncryptedEmailData::from([
            "username" => Crypt::encryptString($username),
            "domain" => Crypt::encryptString($domain)
        ]);
    }

    public function decrypt(string $username, string $domain): string
    {
        $username = Crypt::decryptString($username);
        $domain = Crypt::decryptString($domain);
        return $username . "@" . $domain;
    }
}
