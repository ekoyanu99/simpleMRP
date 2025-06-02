<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalesMstrRequest extends FormRequest
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
            'sales_mstr_nbr' => 'required|string|max:50|unique:sales_mstr,sales_mstr_nbr',
            'sales_mstr_date' => 'required|date',
            'sales_mstr_due_date' => 'required|date|after_or_equal:sales_mstr_date',
            'sales_mstr_bill' => 'required|string|max:100',
            'sales_mstr_ship' => 'required|string|max:100',
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
            'sales_mstr_nbr.required' => 'Nomor penjualan harus diisi.',
            'sales_mstr_nbr.string' => 'Nomor penjualan harus berupa teks.',
            'sales_mstr_nbr.max' => 'Nomor penjualan tidak boleh lebih dari 50 karakter.',
            'sales_mstr_nbr.unique' => 'Nomor penjualan sudah ada.',
            'sales_mstr_date.required' => 'Tanggal penjualan harus diisi.',
            'sales_mstr_date.date' => 'Tanggal penjualan harus berupa tanggal yang valid.',
            'sales_mstr_due_date.required' => 'Tanggal jatuh tempo harus diisi.',
            'sales_mstr_due_date.date' => 'Tanggal jatuh tempo harus berupa tanggal yang valid.',
            'sales_mstr_due_date.after_or_equal' => 'Tanggal jatuh tempo harus setelah atau sama dengan tanggal penjualan.',
            'sales_mstr_bill.required' => 'Alamat tagihan harus diisi.',
            'sales_mstr_bill.string' => 'Alamat tagihan harus berupa teks.',
            'sales_mstr_bill.max' => 'Alamat tagihan tidak boleh lebih dari 100 karakter.',
            'sales_mstr_ship.required' => 'Alamat pengiriman harus diisi.',
            'sales_mstr_ship.string' => 'Alamat pengiriman harus berupa teks.',
            'sales_mstr_ship.max' => 'Alamat pengiriman tidak boleh lebih dari 100 karakter.',
        ];
    }
}
