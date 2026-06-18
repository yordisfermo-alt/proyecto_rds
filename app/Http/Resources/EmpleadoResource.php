<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpleadoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nombres' => $this->nombres,

            'apellidos' => $this->apellidos,

            'fecha_nacimiento' => $this->fecha_nacimiento,

            'fecha_ingreso' => $this->fecha_ingreso,

            'salario' => (float) $this->salario,

            'estado' => (bool) $this->estado,

            'cargo' => $this->whenLoaded('cargo', function () {
                return [
                    'nombre_cargo' => $this->cargo->nombre_cargo,

                    'descripcion' => $this->cargo->descripcion,

                    'funciones' => $this->cargo->funciones->map(function ($funcion) {
                        return [
                            'descripcion_funcion' => $funcion->descripcion_funcion,
                        ];
                    }),
                ];
            }),

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,
        ];
    }
}
