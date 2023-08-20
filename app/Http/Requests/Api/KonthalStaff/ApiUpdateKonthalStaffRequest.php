<?php

namespace App\Http\Requests\Api\KonthalStaff;

use Illuminate\Foundation\Http\FormRequest;

class ApiUpdateKonthalStaffRequest extends FormRequest
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
            'department' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name Field is Required.',
            'department.required' => "Department Field is Required."
        ];
    }
}
