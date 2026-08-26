<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Certificate;

class Employee extends Model
{
    protected $fillable = ['name', 'departament', 'salary'];

    public function certificates()
{
    return $this->hasMany(Certificate::class);
}
}
