<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'название' => $this->title,
        'дата_выдачи' => $this->issued_at,
        'id_сотрудника' => $this->employee_id,
    ];
}
}   
