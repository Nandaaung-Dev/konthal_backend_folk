<?php

namespace App\Http\Requests\Dashboard\ShopType;

use Illuminate\Foundation\Http\FormRequest;

class CreateShopTypeRequest extends FormRequest
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
            'description' => 'required',
        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'Name field is required.',
            'name.unique' => 'Name must be unique.',
            'name_mm.required' => 'Name MM field is required',
            'description.required' => 'Description field is required',

        ];
    }
}
