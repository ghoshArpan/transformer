<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'category' => 'required|string|max:255',

        ];
    }

    public function messages(): array
    {
        return [
            'category.required' => 'Material Name is Required',
            'category.string' => 'Material Name should be string',
            'category.max' => 'Material Name`s maximum length is 255',
        ];
    }
}
