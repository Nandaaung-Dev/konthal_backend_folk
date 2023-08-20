<?php

namespace App\Http\Requests\Api\Shop;

use Illuminate\Foundation\Http\FormRequest;

class ApiCreateShopRequest extends FormRequest
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
            'name' => 'required|unique:shop_types,name',
            'name_mm' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'description' => 'required',
            'shop_type_id' => 'required',
            'owner_id' => 'required',
            'city_id' => 'required',
            'township_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name field is required.',
            'name.unique' => 'Name field must be uniqued.',
            'name_mm.required' => 'Name MM field is required.',
            'phone_number.required' => 'Phone_number field is requirde.',
            'address.required' => 'Address field is requirde.',
            'description.required' => 'Description field is requirde.',
            'shop_type_id.required' => 'Shop_type_id field is requirde.',
            'owner_id.required' => 'Owner_id field is requirde.',
            'city_id.required' => 'City_id field is requirde.',
            'township_id.required' => 'Township_id field is requirde.',
        ];
    }
}
