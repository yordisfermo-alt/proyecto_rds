<?php

use App\Models\Empleado;
use App\Models\Cargo;
use App\Models\FuncionesCargo;
use App\Models\User;

beforeEach(function () {
    $this->actingAs(User::factory()->create(), 'sanctum');

    $this->cargo = Cargo::create([
        'nombre_cargo' => 'Gerente',
        'descripcion' => 'Gerente general'
    ]);
});

test('Puede listar los empleados', function () {
    Empleado::create([
        'nombres' => 'Juan',
        'apellidos' => 'Pérez',
        'fecha_nacimiento' => '1990-01-01',
        'fecha_ingreso' => '2020-01-01',
        'salario' => 2000,
        'estado' => true,
        'id_cargo' => $this->cargo->id,
    ]);

    $response = $this->getJson('/api/empleados');
    $response->assertStatus(200);
    $response->assertJsonCount(1, 'data');
});

test('Puede crear un empleado', function () {
    $response = $this->postJson('/api/empleados', [
        'nombres' => 'Carlos',
        'apellidos' => 'González',
        'fecha_nacimiento' => '1995-05-15',
        'fecha_ingreso' => '2021-03-01',
        'salario' => 2500,
        'estado' => true,
        'id_cargo' => $this->cargo->id,
    ]);

    $response->assertStatus(201);
    $response->assertJsonPath('data.nombres', 'Carlos');
});

test('Puede mostrar un empleado', function () {
    $empleado = Empleado::create([
        'nombres' => 'Ana',
        'apellidos' => 'García',
        'fecha_nacimiento' => '1992-03-20',
        'fecha_ingreso' => '2019-06-01',
        'salario' => 3000,
        'estado' => true,
        'id_cargo' => $this->cargo->id,
    ]);

    $response = $this->getJson("/api/empleados/{$empleado->id}");
    $response->assertStatus(200);
    $response->assertJsonPath('data.nombres', 'Ana');
    $response->assertJsonMissingPath('data.cargo');
});

test('Puede mostrar el detalle completo de un empleado', function () {
    $empleado = Empleado::create([
        'nombres' => 'Ana',
        'apellidos' => 'García',
        'fecha_nacimiento' => '1992-03-20',
        'fecha_ingreso' => '2019-06-01',
        'salario' => 3000,
        'estado' => true,
        'id_cargo' => $this->cargo->id,
    ]);

    $response = $this->getJson("/api/empleados/{$empleado->id}/detalle");
    $response->assertStatus(200);
    $response->assertJsonPath('data.nombres', 'Ana');
    $response->assertJsonPath('data.cargo.nombre_cargo', 'Gerente');
});

test('Muestra el detalle del empleado con las funciones restantes despues de eliminar una funcion', function () {
    $empleado = Empleado::create([
        'nombres' => 'Ana',
        'apellidos' => 'Garcia',
        'fecha_nacimiento' => '1992-03-20',
        'fecha_ingreso' => '2019-06-01',
        'salario' => 3000,
        'estado' => true,
        'id_cargo' => $this->cargo->id,
    ]);

    $funcionEliminada = FuncionesCargo::create([
        'descripcion_funcion' => 'Asignar tareas',
        'estado' => true,
        'id_cargo' => $this->cargo->id,
    ]);

    FuncionesCargo::create([
        'descripcion_funcion' => 'Revisar reportes',
        'estado' => true,
        'id_cargo' => $this->cargo->id,
    ]);

    $this->deleteJson("/api/funciones-cargo/{$funcionEliminada->id}")
        ->assertStatus(200);

    $response = $this->getJson("/api/empleados/{$empleado->id}/detalle");

    $response->assertStatus(200);
    $response->assertJsonPath('data.nombres', 'Ana');
    $response->assertJsonPath('data.cargo.nombre_cargo', 'Gerente');
    $response->assertJsonCount(1, 'data.cargo.funciones');
    $response->assertJsonPath('data.cargo.funciones.0.descripcion_funcion', 'Revisar reportes');
});

test('Muestra mensaje cuando el empleado no existe', function () {
    $response = $this->getJson('/api/empleados/999999');

    $response->assertStatus(404);
    $response->assertJson([
        'success' => false,
        'message' => 'El empleado no existe en la base de datos',
    ]);
});

test('Puede actializar un empleado', function () {
    $empleado = Empleado::create([
        'nombres' => 'Luis',
        'apellidos' => 'López',
        'fecha_nacimiento' => '1988-10-10',
        'fecha_ingreso' => '2018-01-01',
        'salario' => 2200,
        'estado' => true,
        'id_cargo' => $this->cargo->id,
    ]);

    $response = $this->putJson("/api/empleados/{$empleado->id}", [
        'salario' => 2800,
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('empleados', [
        'id' => $empleado->id,
        'salario' => 2800,
    ]);
});

test('Puede eliminar un empleado', function () {
    $empleado = Empleado::create([
        'nombres' => 'Rosa',
        'apellidos' => 'Martínez',
        'fecha_nacimiento' => '1991-07-22',
        'fecha_ingreso' => '2020-09-01',
        'salario' => 2100,
        'estado' => true,
        'id_cargo' => $this->cargo->id,
    ]);

    $response = $this->deleteJson("/api/empleados/{$empleado->id}");
    $response->assertStatus(200);
    $this->assertDatabaseMissing('empleados', ['id' => $empleado->id]);
});

test('Valida los campos obligatorios', function () {
    $response = $this->postJson('/api/empleados', []);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors([
        'nombres', 'apellidos', 'id_cargo'
    ]);
});
