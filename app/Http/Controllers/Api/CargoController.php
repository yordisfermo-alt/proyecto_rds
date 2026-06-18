<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 10), 100));
        $cargos = Cargo::with('empleados', 'funciones')->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $cargos->items(),
            'pagination' => [
                'current_page' => $cargos->currentPage(),
                'last_page' => $cargos->lastPage(),
                'per_page' => $cargos->perPage(),
                'total' => $cargos->total(),
                'from' => $cargos->firstItem(),
                'to' => $cargos->lastItem(),
                'next_page_url' => $cargos->nextPageUrl(),
                'prev_page_url' => $cargos->previousPageUrl(),
            ],
            'message' => 'Cargos obtenidos correctamente'
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_cargo' => 'required|string|max:255|unique:cargos,nombre_cargo',
            'descripcion' => 'nullable|string',
        ]);

        $cargo = Cargo::create($validated);
        
        return response()->json([
            'success' => true,
            'data' => $cargo,
            'message' => 'Cargo creado correctamente'
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cargo $cargo)
    {
        return response()->json([
            'success' => true,
            'data' => $cargo->load('empleados', 'funciones'),
            'message' => 'Cargo obtenido correctamente'
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cargo $cargo)
    {
        $validated = $request->validate([
            'nombre_cargo' => 'sometimes|required|string|max:255|unique:cargos,nombre_cargo,' . $cargo->id,
            'descripcion' => 'nullable|string',
        ]);

        $cargo->update($validated);

        return response()->json([
            'success' => true,
            'data' => $cargo,
            'message' => 'Cargo actualizado correctamente'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cargo $cargo)
    {
        $cargo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cargo eliminado correctamente'
        ],200);
    }
}
