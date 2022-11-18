<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PembelianRequest extends FormRequest
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
            'id_supplier'           => ['required', 'exists:suppliers,id_supplier'],
            'tanggal_pembelian'     => ['required', 'date'],
            'produk.*'              => ['required', 'exists:produks,id_produk'],
            'jumlah.*'              => ['required', 'numeric'],
        ];
    }
}
