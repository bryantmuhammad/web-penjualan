<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return match ($this->method()) {
            'POST' => $this->store(),
            'PUT'  => $this->update()
        };
    }

    private function store()
    {
        return [
            'name'      => ['required', 'string', 'min:2', 'max:255'],
            'email'     => ['required', 'string', 'email:dns', 'unique:users,email'],
            'password'  => ['required', 'confirmed', 'min:4'],
            'role'      => ['required', 'exists:roles,name']
        ];
    }

    public function update()
    {
        return [
            'name'      => ['required', 'string', 'min:2', 'max:255'],
            'email'     => ['required', 'string', 'email:dns', Rule::unique('users')->ignore($this->user->id)],
            'password'  => ['nullable', 'confirmed', 'min:4'],
            'role'      => ['required', 'exists:roles,name']
        ];
    }
}
