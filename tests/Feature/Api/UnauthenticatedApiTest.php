<?php

test('no puede crear un empleado sin estar autenticado', function () {
    $response = $this->postJson('/api/empleados', []);

    $response->assertStatus(401);
    $response->assertJsonPath('success', false);
    $response->assertJsonPath('message', 'No estas autorizado porque no estas autenticado');
});

test('no puede crear un cargo sin estar autenticado', function () {
    $response = $this->postJson('/api/cargos', []);

    $response->assertStatus(401);
    $response->assertJsonPath('success', false);
    $response->assertJsonPath('message', 'No estas autorizado porque no estas autenticado');
});
