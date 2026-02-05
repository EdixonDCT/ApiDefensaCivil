<?php

namespace App\Http\Requests\Action;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Clase UpdateActionRequest
 * * Se encarga de validar la actualización de una Acción existente.
 * Implementa la lógica de exclusión en la regla 'unique' para permitir 
 * que el registro conserve su nombre actual sin disparar errores de validación.
 */
class UpdateActionRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas de validación para la actualización.
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'alpha_spaces',
                'string',
                'max:50',
                /**
                 * Rule::unique: Verifica que el nombre no se repita.
                 * ->ignore(): Ignora el ID del registro actual para evitar 
                 * conflictos de "nombre ya tomado" al guardar cambios sin editar el nombre.
                 */
                Rule::unique('actions', 'name')->ignore($this->route('action')),
            ],
        ];
    }

    /**
     * Mensajes de error personalizados usando :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'El :attribute es obligatorio',
            'name.alpha_spaces' => 'El :attribute debe tener solo letras y espacios',
            'name.string'       => 'El :attribute debe ser texto',
            'name.unique'       => 'El :attribute ya existe',
            'name.max'          => 'El :attribute tiene un máximo de 50 caracteres'
        ];
    }

    /**
     * Define los nombres amigables de los campos.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre de la acción',
        ];
    }
}