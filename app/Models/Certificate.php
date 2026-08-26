<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Certificate extends Model
{
    protected $fillable = ['title', 'issued_at', 'employee_id'];

    public function employee()
{
    return $this->belongsTo(Employee::class);
}
}

