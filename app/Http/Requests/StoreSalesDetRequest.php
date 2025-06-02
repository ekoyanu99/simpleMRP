<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalesDetRequest extends FormRequest
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
            'sales_det_mstr' => 'required|exists:sales_mstr,sales_mstr_id',
            'sales_det_date' => 'required|date',
            'sales_det_duedate' => 'required|date|after_or_equal:sales_det_date',
            'sales_det_item' => 'required|string|exists:item_mstr,item_id',
            'sales_det_desc' => 'nullable|string|max:255',
            'sales_det_qty' => 'required|numeric|min:0.01',
            'sales_det_price' => 'required|numeric|min:0',
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
            'sales_det_mstr.required' => 'Master data penjualan harus dipilih.',
            'sales_det_mstr.exists' => 'Master data penjualan tidak ditemukan.',
            'sales_det_date.required' => 'Tanggal penjualan harus diisi.',
            'sales_det_date.date' => 'Tanggal penjualan harus berupa tanggal yang valid.',
            'sales_det_duedate.required' => 'Tanggal jatuh tempo harus diisi.',
            'sales_det_duedate.date' => 'Tanggal jatuh tempo harus berupa tanggal yang valid.',
            'sales_det_duedate.after_or_equal' => 'Tanggal jatuh tempo harus setelah atau sama dengan tanggal penjualan.',
            'sales_det_item.required' => 'Item penjualan harus dipilih.',
            'sales_det_item.exists' => 'Item penjualan tidak ditemukan.',
            'sales_det_desc.max' => 'Deskripsi tidak boleh lebih dari 255 karakter.',
            'sales_det_qty.required' => 'Jumlah item harus diisi.',
            'sales_det_qty.numeric' => 'Jumlah item harus berupa angka.',
            'sales_det_qty.min' => 'Jumlah item minimal 0.01.',
            'sales_det_price.required' => 'Harga item harus diisi.',
            'sales_det_price.numeric' => 'Harga item harus berupa angka.',
            'sales_det_price.min' => 'Harga item tidak boleh kurang dari 0.',
        ];
    }
}
