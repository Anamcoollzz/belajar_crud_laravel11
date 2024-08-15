<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('POST'))
            return [
                'name'   => 'required',
                'nim'    => 'required|numeric',
                'dob'    => 'required|date',
                'gender' => 'required',
                'avatar' => 'required|image'
            ];

        return [
            'name'   => 'required',
            'nim'    => 'required|numeric',
            'dob'    => 'required|date',
            'gender' => 'required',
            'avatar' => 'nullable|image'
        ];
    }
}
