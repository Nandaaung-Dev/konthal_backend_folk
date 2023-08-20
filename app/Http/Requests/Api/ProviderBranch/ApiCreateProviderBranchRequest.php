<?php

namespace App\Http\Requests\Api\ProviderBranch;

use Illuminate\Foundation\Http\FormRequest;

class ApiCreateProviderBranchRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'provider_id' => 'required',
            'township_id' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Name Field is required.',
            'phone.required' => 'Phone field is required.',
            'email.required' => 'Email field is required',
            'address.required' => 'Address field is required',
            'provider_id.required' => 'Provider_id Field is required.',
            'township_id.required' => 'Township_id field is required',
            'city_id.required' => 'City_id Field is required.',
        ];
    }
}
