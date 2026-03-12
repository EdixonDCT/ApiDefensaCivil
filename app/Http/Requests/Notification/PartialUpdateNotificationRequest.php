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
            'audit_id' => 'sometimes|exists:audits,id',
            'is_read'    => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists'      => 'El usuario no existe',
            'audit_id.exists'   => 'El auditorio no existe',
            'is_read.boolean'     => 'El estado leído debe ser verdadero o falso',
        ];
    }
}
