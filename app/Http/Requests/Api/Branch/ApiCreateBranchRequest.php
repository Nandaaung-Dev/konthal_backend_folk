<?php

namespace App\Http\Requests\Api\Branch;

use Illuminate\Foundation\Http\FormRequest;

class ApiCreateBranchRequest extends FormRequest
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
            'name_mm' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'description' => 'required',
            'city_id'=>'required',
            'township_id' => 'required',
            'shop_id' => 'required',
            'shop_type_id' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Name Field is required.',
            'name_mm.required' => 'Name MM field is required.',
            'phone_number.required' => 'Phone_number field is required',
            'address.required' => 'Address field is required',
            'description.required' => 'Description field is required',
            'city_id.required' => 'City_id Field is required.',
            'township_id.required' => 'Township_id field is required',
            'shop_id.required' => 'Shop_id field is required',
            'shop_type_id.required' => 'Shop_type_id field is required',
        ];
    }
}
