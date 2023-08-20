<?php

namespace App\Http\Requests\Dashboard\Township;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTownshipRequest extends FormRequest
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
                'name' => 'required|unique:townships,name',
                'name_mm' => 'required',
                'city_id' => ' required',
        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'Name field is required.',
            'name.unique' => 'Name must be unique.',
            'name_mm.required' => 'Name MM field is required',
            'city_id.required' => 'City field is required',

        ];
    }
}
