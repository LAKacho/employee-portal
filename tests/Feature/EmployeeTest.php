<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{

    use RefreshDatabase;
public function test_can_create_employee(): void
{
    $admin = \App\Models\User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($admin)->postJson('/api/v1/employees', [
        'name' => 'Тестовый',
        'departament' => 'ТБ',
        'salary' => 50000,
    ]);

    $response->assertStatus(201);

    $this->assertDatabaseHas('employees', [
        'name' => 'Тестовый',
        'departament' => 'ТБ',
        'salary' => 50000,
    ]);
}


    public function test_cannot_create_employee_without_name(): void
{
    $admin = \App\Models\User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($admin)->postJson('/api/v1/employees', [
        'departament' => 'ТБ',
        'salary' => 50000,
    ]);

    $response->assertStatus(422);
}

public function test_guest_cannot_create_employee(): void
{
    $response = $this->postJson('/api/v1/employees', [
        'name' => 'Тестовый',
        'departament' => 'ТБ',
        'salary' => 50000,
    ]);

    $response->assertStatus(401);
}

}

