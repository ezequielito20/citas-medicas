<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'description' => 'nullable|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'patient_id.required' => 'El paciente es requerido',
            'patient_id.exists' => 'El paciente seleccionado no existe',
            'doctor_id.required' => 'El doctor es requerido',
            'doctor_id.exists' => 'El doctor seleccionado no existe',
            'amount.required' => 'El monto es requerido',
            'amount.numeric' => 'El monto debe ser un número',
            'amount.min' => 'El monto debe ser mayor a 0',
            'payment_date.required' => 'La fecha de pago es requerida',
            'payment_date.date' => 'La fecha de pago debe ser una fecha válida',
            'description.max' => 'La descripción no debe exceder los 255 caracteres'
        ];
    }
}
