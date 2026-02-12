<?php

namespace App\Http\Requests\Resource;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /**
         * Obtenemos el ID del recurso desde la ruta
         * Asegúrate que el parámetro en tu ruta se llame {resource_id}
         */
        $resourceId = $this->route('resource_id');

        return [
            /**
             * El nombre es obligatorio y único,
             * pero ignorando el registro actual
             */
            'name'      => "required|string|max:255|unique:resources,name,{$resourceId}",
            'service'   => 'required|string|max:255',
            'active'    => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del recurso es obligatorio',
            'name.string'   => 'El nombre del recurso debe ser texto',
            'name.max'      => 'El nombre del recurso no puede superar los 255 caracteres',
            'name.unique'   => 'El nombre del recurso ya se encuentra registrado',

            'service.required' => 'El servicio es obligatorio',
            'service.string'   => 'El servicio debe ser texto',
            'service.max'      => 'El servicio no puede superar los 255 caracteres',

            'active.required' => 'El estado es obligatorio',
            'active.boolean'  => 'El estado debe ser verdadero o falso',
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
