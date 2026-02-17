<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'    => 'required|exists:users,id',
            'history_id' => 'required|exists:histories,id',
            'is_read'    => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required'    => 'El usuario es obligatorio',
            'user_id.exists'      => 'El usuario no existe',
            'history_id.required' => 'El historial es obligatorio',
            'history_id.exists'   => 'El historial no existe',
            'is_read.required'    => 'El estado de lectura es obligatorio',
            'is_read.boolean'     => 'El campo leído debe ser verdadero o falso',
        ];
    }
}
