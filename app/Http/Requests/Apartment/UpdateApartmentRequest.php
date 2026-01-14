<?php

namespace App\Http\Requests\Apartment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $apartment = $this->route('apartment_id');
        return [
            'name' => 'required|alpha_spaces|string|max:50|unique:apartments,name,'.$apartment,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del apartamento es obligatorio.',
            'name.alpha_spaces' => 'El nombre del apartamento debe tener solo letras y espacios.',
            'name.string' => 'El nombre del apartamento debe tener solo caracteres de tipo texto.',
            'name.unique' => 'El apartamento ya existe.',
            'name.max' => 'El nombre del apartamento tiene maximo 50 caracteres.',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre del apartamento',
            ];
    }
}
