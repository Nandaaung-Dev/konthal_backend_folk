<?php

namespace App\Http\Requests\Api\Category;

use Illuminate\Foundation\Http\FormRequest;

class ApiCreateCategoryRequest extends FormRequest
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
            'main_category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field is required.',
            'name_mm.required' => 'Name MM field is required.',
            'main_category_id.required' => 'main_category_id field is required.',
        ];
    }
}
