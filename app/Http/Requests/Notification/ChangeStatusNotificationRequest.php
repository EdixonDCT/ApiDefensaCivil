<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusNotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_read' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'is_read.required'    => 'El estado de leido es obligatorio',
            'is_read.boolean'     => 'El estado de leido debe ser verdadero o falso',
        ];
    }
}
