<?php

namespace App\Http\Requests\Dashboard\Owner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOwnerRequest extends FormRequest
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
            'name' => 'required|unique:owners',
            'phone_number' => 'required|integer',
            'city_id' => 'required',
            'township_id' => 'required',
            'address' => 'required'
        ];
        
    }
    public function messages()
    {
        return[
            'username.required' => 'Username field is required',
            'email.required' => 'Email field is required',
            'password.required' => 'Password field is required',
            'name.required' => 'Name fiel is required',
            'name.unique' => 'Name must be unique',
            'phone_number.unique' => 'Phone Number is required',
            'city_id.required' => 'City_id field is required',
            'township_id.required' => 'Township field is required',
            'address.required' => 'Address field is required',
        ];
    }
}
