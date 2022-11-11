<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return auth()->user()->is_admin
            || $this->user_id == auth()->id();
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
            'za_id_number' => ['required',  Rule::unique('users')->ignore($this->user_id),],
            'birth_date' => 'required',
            'mobile_number' => ['required', Rule::unique('users')->ignore($this->user_id)],
            'email' => ['required','email', Rule::unique('users')->ignore($this->user_id)],
            'is_admin' => 'boolean',
            'interests' => 'required'
        ];
    }
}
