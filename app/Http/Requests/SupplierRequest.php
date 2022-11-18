<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierRequest extends FormRequest
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
            'nama_supplier'         => ['required', 'max:50', Rule::unique('suppliers')->ignore($this->supplier)],
            'alamat_supplier'       => ['required'],
            'no_telepon_supplier'   => ['required', 'numeric']
        ];
    }
}
