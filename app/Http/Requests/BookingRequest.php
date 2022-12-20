<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'activity_id' => 'required|integer',
            'date' => 'required|date',
            'participants' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'El campo fecha es obligatorio',
            'date.date' => 'El campo fecha debe ser una fecha válida',
            'participants.required' => 'El campo participantes es obligatorio',
            'participants.integer' => 'El campo participantes debe ser un número entero',
        ];
    }

}
