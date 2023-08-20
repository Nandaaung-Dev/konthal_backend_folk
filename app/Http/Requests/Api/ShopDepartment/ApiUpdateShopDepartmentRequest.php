<?php

namespace App\Http\Requests\Api\ShopDepartment;

use Illuminate\Foundation\Http\FormRequest;

class ApiUpdateShopDepartmentRequest extends FormRequest
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
            //
            'name' => 'required',
            'name_mm' => 'required',
            'shop_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name Field is Required.',
            'name_mm.required' => 'Name MM field is Required.',
            'shop_id.required' => 'Shop Id Field is Required.',
        ];
    }
}
