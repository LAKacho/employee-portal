<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CertificateData extends Data 
{
    public function __construct(
        public int    $id,
        public string $title,
        public string $issued_at,
        public int    $employee_id
    ) {}
}