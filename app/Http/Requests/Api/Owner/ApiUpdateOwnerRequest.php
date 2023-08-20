<?php

namespace App\Http\Requests\Api\Owner;

use Illuminate\Foundation\Http\FormRequest;

class ApiUpdateOwnerRequest extends FormRequest
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
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'township_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username field is required.',
            'email.required' => 'Email field is required.',
            'password.required' => 'Password field is required.',
            'name.required' => 'Name field is required.',
            'phone_number.required' => 'Phone_number field is required.',
            'address.required' => 'Address field is required.',
            'city_id.required' => 'City field is required.',
            'township_id.required' => 'Towhship field is required.',
        ];
    }
}
