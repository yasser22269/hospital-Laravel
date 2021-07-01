<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurgeryRequest extends FormRequest
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
            "startTime" => 'required|date',
            "endTime" => 'required|date',
            'doctor_id' => 'numeric|exists:admins,id',
            'patient_id' => 'numeric|exists:patients,id',
        ];
    }


}
