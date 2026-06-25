<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FuncionesCargo;
use Illuminate\Http\Request;

class FuncionesCargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 10), 100));
        $funcionesCargo = FuncionesCargo::paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $funcionesCargo->items(),
            'pagination' => [
                'current_page' => $funcionesCargo->currentPage(),
                'last_page' => $funcionesCargo->lastPage(),
                'per_page' => $funcionesCargo->perPage(),
                'total' => $funcionesCargo->total(),
                'from' => $funcionesCargo->firstItem(),
                'to' => $funcionesCargo->lastItem(),
                'next_page_url' => $funcionesCargo->nextPageUrl(),
                'prev_page_url' => $funcionesCargo->previousPageUrl(),
            ],
            'message' => 'Funciones de cargo obtenidas correctamente'
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //valdación
        $validated = $request->validate([
            'descripcion_funcion' => 'required|string',
            'estado' => 'required|boolean',
            'id_cargo' => 'required|exists:cargos,id',
        ]);

        $funcion = FuncionesCargo::create($validated);
        return response()->json([
            'success' => true,
            'data' => $funcion,
            'message' => 'Funcion de cargo creada correctamente'
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(FuncionesCargo $funciones_cargo)
    {
        return response()->json([
            'success' => true,
            'data' => $funciones_cargo,
            'message' => 'Funcion de cargo obtenida correctamente'
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FuncionesCargo $funciones_cargo)
    {
        //validacion
        $validated = $request->validate([
            'descripcion_funcion' => 'sometimes|required|string',
            'estado' => 'sometimes|required|boolean',
            'id_cargo' => 'sometimes|required|exists:cargos,id',
        ]);

        $funciones_cargo->update($validated);

        return response()->json([
            'success' => true,
            'data' => $funciones_cargo,
            'message' => 'Funcion de cargo actualizada correctamente'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuncionesCargo $funciones_cargo)
    {
        $funciones_cargo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Funcion de cargo eliminada correctamente'
        ],200);
    }
}
