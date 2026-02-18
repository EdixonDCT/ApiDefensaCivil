<?php

namespace App\Http\Requests\Resource;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateResourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /**
         * Obtenemos el ID desde la ruta
         * Debe coincidir con el parámetro definido en la ruta
         */
        $resourceId = $this->route('resource_id');

        return [
            'name' => "sometimes|string|max:255|unique:resources,name,{$resourceId}",
            'service' => 'sometimes|string|max:255',
            'is_active' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El nombre debe ser un texto',
            'name.max'    => 'El nombre no puede exceder 255 caracteres',
            'name.unique' => 'El nombre ya se encuentra registrado',

            'service.string' => 'El servicio debe ser un texto',
            'service.max'    => 'El servicio no puede exceder 255 caracteres',

            'is_active.boolean' => 'El valor de activo debe ser verdadero o falso',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'    => 'nombre del recurso',
            'service' => 'servicio',
            'active'  => 'estado del recurso',
        ];
    }
}
