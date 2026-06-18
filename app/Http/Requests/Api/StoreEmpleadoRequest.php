<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmpleadoRequest extends FormRequest
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
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'fecha_ingreso' => 'required|date',
            'salario' => 'required|numeric|min:0',
            'estado' => 'required|boolean',
            'id_cargo' => 'required|exists:cargos,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nombres.required' => 'El nombre es requerido',
            'apellidos.required' => 'El apellido es requerido',
            'id_cargo.exists' => 'El cargo seleccionado no existe',
        ];
    }
}
