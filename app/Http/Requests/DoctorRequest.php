<?php

namespace App\Http\Requests;

use App\Rules\UniqueCategoryName;
use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
                "name" => 'required|string|max:100|unique:admins,name,'.$this->id,
                "email" => 'required|string|email|unique:admins,email,'.$this->id,
                "shift_id" => 'required',
                "password" => 'nullable|required_without:id',
        ];
    }
}
