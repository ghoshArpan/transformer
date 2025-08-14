<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Change to your authorization logic if needed
    }

    
        public function rules()
        {
            $rules = [
                'status' => 'required|integer',
            ];
    
            $status = $this->input('status'); // Get the status value from request
    
            if ($status == 2) {
                $rules['dis_date'] = 'required|date';
                $rules['dis_reason'] = 'required|string';
            }
    
            if ($status == 6) {
                $rules['invoice'] = 'required|string';
            }
    
            if ($status == 7) {
                $rules['submit_no'] = 'required|string';
                $rules['bill_submit_date'] = 'required|date';
            }
    
            if ($status == 8) {
                $rules['paid_date'] = 'required|date';
                $rules['bill_tt'] = 'required|string';
                $rules['rec_value'] = 'required|string';
                $rules['ddc'] = 'required|string';
                $rules['sd_amt'] = 'required|string';
                $rules['sd_claimed'] = 'required|string';
                $rules['sd_paid'] = 'required|string';
            }
    
            return $rules;
        }
    
        public function messages()
        {
            return [
                'dis_date.required' => 'The disbursement date is required when status is 2.',
                'dis_reason.required' => 'The disbursement reason is required when status is 2.',
                'invoice.required' => 'The invoice is required when status is 6.',
                'submit_no.required' => 'The submit number is required when status is 7.',
                'bill_submit_date.required' => 'The bill submission date is required when status is 7.',
                'paid_date.required' => 'The paid date is required when status is 8.',
                'bill_tt.required' => 'The bill transaction type is required when status is 8.',
                'rec_value.required' => 'The received value is required when status is 8.',
                'ddc.required' => 'The DDC is required when status is 8.',
                'sd_amt.required' => 'The SD amount is required when status is 8.',
                'sd_claimed.required' => 'The SD claimed amount is required when status is 8.',
                'sd_paid.required' => 'The SD paid amount is required when status is 8.',
            ];
        }
    
    }
