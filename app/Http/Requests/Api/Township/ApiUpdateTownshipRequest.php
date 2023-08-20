<?php

namespace App\Http\Requests\Api\Township;

use Illuminate\Foundation\Http\FormRequest;

class ApiUpdateTownshipRequest extends FormRequest
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
            'city_id' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Name Field is Required.',
            'name_mm.required' => 'Name MM field is Required.',
            'city_id.required' => 'City  Field is Required.',
        ];
    }
}
