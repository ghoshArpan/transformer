<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransformerCreateRequest extends FormRequest
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
            'office_name' => 'required',
            // 'financial_yr' => 'required',
            // 'kva' => 'required',
            'work_name' => 'required',
            
        ];
		
    }
}
