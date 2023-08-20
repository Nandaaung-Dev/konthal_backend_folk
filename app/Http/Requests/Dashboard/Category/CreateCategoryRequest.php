<?php

namespace App\Http\Requests\Dashboard\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
                'name' => 'required|unique:categories,name',
                'type_id' => 'required',
                
        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'Name field is required.',
            'name.unique' => 'Name must be unique.',
            'type_id.required' => 'Type field is required',
            

        ];
    }
}
