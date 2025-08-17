<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RawMeterialRequest extends FormRequest
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
        return [
            'category_id' => 'required|exists:raw_meterial_category,code',
            'sub_category_id' => 'required|exists:raw_meterial_sub_category,code',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('raw_meterial')->where(function ($query) {
                    return $query->where('category_id', request('category_id'))
                        ->where('sub_category_id', request('sub_category_id'));
                }),
            ],
            'rate' => 'required|numeric',
            'unit' => 'required',
        ];

        // use Illuminate\Validation\Rule;
    }

    /**
     * Get the custom validation messages.
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Please select a Material Name.',
            'sub_category_id.required' => 'Please select a Specification.',
            'name.required' => 'The Description field is required.',
            'name.string' => 'The Description must be a valid text.',
            'name.max' => 'The Description cannot exceed 255 characters.',
            'rate.required' => 'The rate field is required.',
            'unit.required' => 'The unit field is required.',
            'rate.numeric' => 'The rate must be a valid number.',
        ];
    }
}
