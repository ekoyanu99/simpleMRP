<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalesDetRequest extends FormRequest
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
            'efid_Date' => 'nullable|date',
            'efid_Duedate' => 'nullable|date|after_or_equal:efid_Date',
            'efid_Qty' => 'nullable|numeric|min:0.01',
            'efid_Price' => 'nullable|numeric|min:0',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'efid_Date.date' => 'Tanggal harus berupa tanggal yang valid.',
            'efid_Duedate.date' => 'Tanggal jatuh tempo harus berupa tanggal yang valid.',
            'efid_Duedate.after_or_equal' => 'Tanggal jatuh tempo harus setelah atau sama dengan tanggal penjualan.',
            'efid_Qty.numeric' => 'Jumlah item harus berupa angka.',
            'efid_Qty.min' => 'Jumlah item minimal 0.01.',
            'efid_Price.numeric' => 'Harga item harus berupa angka.',
            'efid_Price.min' => 'Harga item tidak boleh kurang dari 0.',
        ];
    }
}
