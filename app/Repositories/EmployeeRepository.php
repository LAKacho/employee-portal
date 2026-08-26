<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository
{
    public function findAll(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        return Employee::query()
            ->when($filters['name'] ?? null, function ($query, $name) {
                $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($filters['departament'] ?? null, function ($query, $departament) {
                $query->where('departament', $departament);
            })
            ->paginate($perPage);
    }

    public function findById(int $id): ?Employee
    {
        return Employee::with('certificates')->find($id);
    }


public function create(array $data): Employee 
{
    return Employee::create($data);
} 
    
public function update(int $id, array $data): ?Employee
{
    $employee = Employee::find($id);

    if (!$employee) {
        return null;
    }

    $employee->update($data);

    return $employee;
}


public function destroy(int $id): bool
{
    $employee = Employee::find($id);

    if (!$employee) {
        return false;
    }

    return $employee->delete();
}

}