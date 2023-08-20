<?php

namespace App\Http\Requests\Dashboard\Branch;

use Illuminate\Foundation\Http\FormRequest;

class CreateBranchRequest extends FormRequest
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
                'name' => 'required|unique:branches',
                'name_mm' => 'required',
                'phone_number' => ' required|integer',
                'address' => ' required',
                'description' => ' required',
                'shop_id' => ' required',
                'shop_type_id' => ' required',
                'city_id' => ' required',
                'township_id' => ' required',
        ];
    }
    public function messages()
    {
        return [
                'name.required' => 'Name field is reqiured.',
                'name.unique' => 'Name field must be unique.',
                'name_mm.required' => 'Name MM field is required.',
                'phone_number.required' => 'Phone field is required',
                'address.required' => 'Address field is required',
                'description.required' => 'Description field is required',
                'shop_id.required' => 'Shop field is required',
                'shop_type_id.required' => 'Shoptype field is required',
                'city_id.required' => 'City Id field is required',
                'township_id.required' => 'Township Id field is required',

        ];
    }
}
