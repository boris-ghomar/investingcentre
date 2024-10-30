<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class EncryptedEmailData extends Data
{
    public function __construct(
        public string $username,
        public string $domain,
    ) {}
}
