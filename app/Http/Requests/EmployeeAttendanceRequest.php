<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeAttendanceRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'employee_id' => 'required',
            'intime' => 'required',


        ];
    }

    public function messages()
    {
        return [
            'employee_id.required' => 'The employee name field is required.',
            'intime.required' => 'The in time field is required.',
        ];
    }
}
