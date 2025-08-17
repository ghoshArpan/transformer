<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryCreateRequest extends FormRequest
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
            'category_id' => 'required|string|max:255',
            'sub_category' => 'required|string|max:255',

        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Material Name is Required',
            'category.string' => 'Material Name should be string',
            'category.max' => 'Material Name`s maximum length is 255',
            'sub_category.required' => 'Specification is Required',
            'sub_category.string' => 'Specification should be string',
            'sub_category.max' => 'Specification`s maximum length is 255',
        ];
    }
}
