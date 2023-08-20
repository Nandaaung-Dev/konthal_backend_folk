<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;

class ApiUpdateProductRequest extends FormRequest
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
            'price' => 'required',
            'shop_id' => 'required',
            'branch_id' => 'required',
            'category_id' => 'required',
            'brand_id'=>'required'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Name Field is Required.',
            'name_mm.required' => 'Name field is Required.',
            'price.required' => 'Price field is Reruired',
            'shop_id.required' => 'Shop field is Reruired',
            'branch_id.required' => 'Branch Field is Required.',
            'category_id.required' => 'Category Field is Required.',
            'brand_id.required' => 'Brand Field is Required.',
        ];
    }
}
