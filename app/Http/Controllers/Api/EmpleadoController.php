<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Http\Requests\Api\StoreEmpleadoRequest;
use App\Http\Requests\Api\UpdateEmpleadoRequest;
use App\Http\Resources\EmpleadoResource;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = max(1, min((int) $request->query('per_page', 10), 100));
        $empleados = Empleado::paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => EmpleadoResource::collection($empleados->getCollection()),
            'pagination' => [
                'current_page' => $empleados->currentPage(),
                'last_page' => $empleados->lastPage(),
                'per_page' => $empleados->perPage(),
                'total' => $empleados->total(),
                'from' => $empleados->firstItem(),
                'to' => $empleados->lastItem(),
                'next_page_url' => $empleados->nextPageUrl(),
                'prev_page_url' => $empleados->previousPageUrl(),
            ],
            'message' => 'Empleados obtenidos correctamente'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmpleadoRequest $request)
    {
        $validated = $request->validated();
        $empleado = Empleado::create($validated);

        return response()->json([
            'success' => true,
            'data' => new EmpleadoResource($empleado),
            'message' => 'Empleado creado correctamente'
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        return response()->json([
            'success' => true,
            'data' => new EmpleadoResource($empleado),
            'message' => 'Empleado obtenido correctamente'
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmpleadoRequest $request, Empleado $empleado)
    {
        $validated = $request->validated();
        $empleado->update($validated);

        return response()->json([
            'success' => true,
            'data' => new EmpleadoResource($empleado),
            'message' => 'Empleado actualizado correctamente'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return response()->json([
            'success' => true,
            'message' => 'Empleado eliminado correctamente'
        ],200); 
    }
}
