<?php

namespace App\Http\Requests\Api\Provider;

use Illuminate\Foundation\Http\FormRequest;

class ApiCreateProviderRequest extends FormRequest
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
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'township_id' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Name Field is Required.',
            'name.unique' => 'Name Field must be uniqued.',
            'phone.required' => 'Phone field is Required.',
            'email.required' => 'Email field is Reruired',
            'address.required' => 'Address field is Reruired',
            'township_id.required' => 'Township_id field is Reruired',
            'city_id.required' => 'City Id Field is Required.',
        ];
    }
}
