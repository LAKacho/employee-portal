<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Data\EmployeeData;
use App\Http\Resources\CertificateResource;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;


class EmployeeController extends Controller
{
    public function hello()
    {
        return "Привет от employee-portal API";
    }


public function index(Request $request)
{
    $filters = $request->only(['name', 'departament', 'min_salary']);
    $employees = $this->repo->findAll($filters);

    
    return response()->json($employees, 200, [
        'X-Total-Count' => $employees->total(),
    ], JSON_UNESCAPED_UNICODE);
}




    public function __construct( 
        private EmployeeRepository $repo 
    ) {}


public function show(int $id)
{
    $employee = $this->repo->findById($id);
    $data = EmployeeData::from($employee);

    return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
}



public function list(Request $request)
{
    $filters = $request->only(['name', 'departament', 'min_salary']);
    $employees = $this->repo->findAll($filters);

    return view('employees', [
        'employees' => $employees,
        'filters' => $filters,
    ]);
}

public function store(StoreEmployeeRequest $request)
{
    $validated = $request->validated();

    $this->repo->create($validated);

    return response()->json($validated, 201);
}

public function destroy(int $id)
{
    $deleted = $this->repo->destroy($id);

    if (!$deleted) {
        return response()->json(['message' => 'Сотрудник не найден'], 404);
    }

    return response()->json(['message' => 'Удалено'], 200);
}

public function update(UpdateEmployeeRequest $request, int $id)
{
        $validated = $request->validated();

    $updated = $this->repo->update($id, $validated);
    if (!$updated) {
        return response()->json(['message' => 'Сотрудник не найден'], 404);
    }
    $data = EmployeeData::from($updated);
    return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
}

public function certificates(int $id)
{
    $employee = $this->repo->findById($id);
    if (!$employee) {
        return response()->json(['message' => 'Сотрудник не найден'], 404);
    }
    return response()->json(
        CertificateResource::collection($employee->certificates)->resolve(),
        200,
        [],
        JSON_UNESCAPED_UNICODE
    );
}
}