<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateNotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'    => 'sometimes|exists:users,id',
            'history_id' => 'sometimes|exists:histories,id',
            'is_read'    => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists'      => 'El usuario no existe',
            'history_id.exists'   => 'El historial no existe',
            'is_read.boolean'     => 'El campo leído debe ser verdadero o falso',
        ];
    }
}
