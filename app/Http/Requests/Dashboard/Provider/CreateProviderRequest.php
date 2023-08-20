<?php

namespace App\Http\Requests\Dashboard\Provider;

use Illuminate\Foundation\Http\FormRequest;

class CreateProviderRequest extends FormRequest
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
            'name' => 'required|unique:providers,name',
            'phone' => 'required|integer',
            'email' => 'required|email|unique:providers',
            'address' => 'required',
            'city_id' => 'required|integer',
            'township_id' => 'required|integer'
        ];
        
    }
    public function messages()
    {
        return[
            'name.required' => 'Name field is reqiured.',
            'name.unique' => 'Name field must be unique.',
            'phone' => 'Phone field is required.',
            'email.required' => 'Email field is required.',
            'email.unique' => 'Email field must be unique.',
            'email.email' => 'Email must be valid email format.',
            'address' => 'Address field is required.',
            'city_id' => 'City field is required.',
            'township_id' => 'Township field is required.'
        ];
    }
}
