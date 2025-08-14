<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabourCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Change to your authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
		//dd(request()->all());
        return [
            'name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:10|min:10',
           'per_day_wages' => 'required|numeric',

            
        ];
		
    }
	
	public function messages(): array
{
    return [
        'name.required' => 'Please enter the name.',
        'name.string' => 'The name must be a valid text.',
        'name.max' => 'The name cannot exceed 255 characters.',

        'phone_no.required' => 'Please enter the phone number.',
        'phone_no.string' => 'The phone number must be a valid input.',
        'phone_no.min' => 'The phone number must be exactly 10 digits.',
        'phone_no.max' => 'The phone number must be exactly 10 digits.',

        'per_day_wages.required' => 'Please enter the per-day wages.',
        'per_day_wages.numeric' => 'The per-day wages must be a valid number.',
    ];
}
}
