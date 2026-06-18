<?php

use App\Models\Cargo;
use App\Models\User;

beforeEach(function () {
    $this->actingAs(User::factory()->create(), 'sanctum');
});

test('puede listar todos los cargos', function () {
    Cargo::create([
        'nombre_cargo' => 'Director',
        'descripcion' => 'Director general'
    ]);

    $response = $this->getJson('/api/cargos');
    $response->assertStatus(200);
    $response->assertJsonCount(1, 'data');
});

test('Puedes crear un cargo', function () {
    $response = $this->postJson('/api/cargos', [
        'nombre_cargo' => 'Supervisor',
        'descripcion' => 'Supervisor de equipo'
    ]);

    $response->assertStatus(201);
    $response->assertJsonPath('data.nombre_cargo', 'Supervisor');
});

test('Puede mostrar un cargo', function () {
    $cargo = Cargo::create([
        'nombre_cargo' => 'Analista',
        'descripcion' => 'Analista de sistemas'
    ]);

    $response = $this->getJson("/api/cargos/{$cargo->id}");
    $response->assertStatus(200);
    $response->assertJsonPath('data.id', $cargo->id);
});

test('Muestra mensaje cuando el cargo no existe', function () {
    $response = $this->getJson('/api/cargos/999999');

    $response->assertStatus(404);
    $response->assertJson([
        'success' => false,
        'message' => 'El cargo no existe en la base de datos',
    ]);
});

test('Puede actualizar un cargo', function () {
    $cargo = Cargo::create([
        'nombre_cargo' => 'Técnico',
        'descripcion' => 'Técnico en sistemas'
    ]);

    $response = $this->putJson("/api/cargos/{$cargo->id}", [
        'descripcion' => 'Técnico senior'
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('cargos', [
        'id' => $cargo->id,
        'descripcion' => 'Técnico senior'
    ]);
});

test('Puede eliminar un cargo', function () {
    $cargo = Cargo::create([
        'nombre_cargo' => 'Asistente',
        'descripcion' => 'Asistente administrativo'
    ]);

    $response = $this->deleteJson("/api/cargos/{$cargo->id}");
    $response->assertStatus(200);
    $this->assertDatabaseMissing('cargos', ['id' => $cargo->id]);
});

test('Valida que nombre_cargo sea unico', function () {
    Cargo::create(['nombre_cargo' => 'Gerente']);

    $response = $this->postJson('/api/cargos', [
        'nombre_cargo' => 'Gerente'
    ]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors('nombre_cargo');
});
