<?php

namespace App\Http\Requests\Api\City;

use Illuminate\Foundation\Http\FormRequest;

class ApiCreateCityRequest extends FormRequest
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
            'name' => 'required|unique:cities,name',
            'name_mm' => 'required',
            'region_id' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Name Field is Required.',
            'name.unique' => 'Name Field must be uniqued.',
            'name_mm.required' => 'Name MM field is Required.',
            'region_id.required' => 'Region Id Field is Required.',
        ];
    }
}
