<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;

class EmployeeData extends Data 
{
    public function __construct(
        public int    $id,
        public string $name,
        public string $departament,
        public int    $salary,
        #[DataCollectionOf(CertificateData::class)]
        public DataCollection $certificates
    ) {}
}