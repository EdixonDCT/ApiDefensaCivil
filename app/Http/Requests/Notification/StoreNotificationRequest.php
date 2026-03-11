<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'    => 'required|exists:users,id',
            'audit_id' => 'required|exists:audits,id',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required'    => 'El usuario es obligatorio',
            'user_id.exists'      => 'El usuario no existe',
            'audit_id.required' => 'La auditoria es obligatoria',
            'audit_id.exists'   => 'La auditoria no existe'
        ];
    }
}
