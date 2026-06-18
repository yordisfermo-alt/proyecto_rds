<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombres' => 'sometimes|string|max:100',
            'apellidos' => 'sometimes|string|max:100',
            'fecha_nacimiento' => 'sometimes|date',
            'fecha_ingreso' => 'sometimes|date',
            'salario' => 'sometimes|numeric|min:0',
            'estado' => 'sometimes|boolean',
            'id_cargo' => 'sometimes|exists:cargos,id',
        ];
    }
}
