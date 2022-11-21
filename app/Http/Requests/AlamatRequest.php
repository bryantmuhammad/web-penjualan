<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlamatRequest extends FormRequest
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
        return match ($this->method()) {
            'POST'  => $this->store(),
            'PUT'   => $this->update()
        };
    }

    public function store()
    {
        return [
            'id_kabupaten'          => ['required', 'exists:kabupatens,id_kabupaten'],
            'kecamatan'             => ['required', 'max:50'],
            'kode_pos'              => ['required', 'numeric', 'digits_between:1,20'],
            'alamat'                => ['required'],
            'nama_penerima'         => ['required', 'max:40'],
            'no_telepon_penerima'   => ['required', 'numeric', 'digits_between:1,20']
        ];
    }
}
