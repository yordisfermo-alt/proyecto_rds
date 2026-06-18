<?php

use App\Models\FuncionesCargo;
use App\Models\Cargo;
use App\Models\User;

beforeEach(function () {
    $this->actingAs(User::factory()->create(), 'sanctum');

    $this->cargo = Cargo::create([
        'nombre_cargo' => 'Gerente',
        'descripcion' => 'Gerente general'
    ]);
});

test('Puede listar todas las funciones cargo', function () {
    FuncionesCargo::create([
        'descripcion_funcion' => 'Dirigir el equipo',
        'estado' => true,
        'id_cargo' => $this->cargo->id,
    ]);

    $response = $this->getJson('/api/funciones-cargo');
    $response->assertStatus(200);
    $response->assertJsonCount(1, 'data');
});

test('Puede crear un funcion cargo', function () {
    $response = $this->postJson('/api/funciones-cargo', [
        'descripcion_funcion' => 'Tomar decisiones',
        'estado' => true,
        'id_cargo' => $this->cargo->id,
    ]);

    $response->assertStatus(201);
    $response->assertJsonPath('data.descripcion_funcion', 'Tomar decisiones');
});

test('puede mostrar una funcion cargo', function () {
    $funcion = FuncionesCargo::create([
        'descripcion_funcion' => 'Supervisar',
        'estado' => true,
        'id_cargo' => $this->cargo->id,
    ]);

    $response = $this->getJson("/api/funciones-cargo/{$funcion->id}");
    $response->assertStatus(200);
    $response->assertJsonPath('data.id', $funcion->id);
});

test('Puede actualizar una funcion cargo', function () {
    $funcion = FuncionesCargo::create([
        'descripcion_funcion' => 'Revisar reportes',
        'estado' => true,
        'id_cargo' => $this->cargo->id,
    ]);

    $response = $this->putJson("/api/funciones-cargo/{$funcion->id}", [
        'estado' => false,
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('funciones_cargo', [
        'id' => $funcion->id,
        'estado' => false,
    ]);
});

test('Puede eliminar una funcion cargo', function () {
    $funcion = FuncionesCargo::create([
        'descripcion_funcion' => 'Asignar tareas',
        'estado' => true,
        'id_cargo' => $this->cargo->id,
    ]);

    $response = $this->deleteJson("/api/funciones-cargo/{$funcion->id}");
    $response->assertStatus(200);
    $this->assertDatabaseMissing('funciones_cargo', ['id' => $funcion->id]);
});

test('Validar campos obligatorios', function () {
    $response = $this->postJson('/api/funciones-cargo', []);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors([
        'descripcion_funcion', 'id_cargo'
    ]);
});
