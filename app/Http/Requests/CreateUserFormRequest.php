<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'language_id' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'za_id_number' => 'required|unique:users',
            'birth_date' => 'required',
            'mobile_number' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'is_admin' => 'boolean',
            'interests' => 'required'
        ];
    }
}
