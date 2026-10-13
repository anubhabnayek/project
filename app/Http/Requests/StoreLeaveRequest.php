<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // return auth()->check() &&
        //     auth()->user()->role === 'employee';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'leave_type' => [
                'required',
                'string',
                'max:100',
            ],

            'from_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'to_date' => [
                'required',
                'date',
                'after_or_equal:from_date',
            ],

            'reason' => [
                'required',
                'string',
                'max:1000',
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'leave_type.required' => 'Please select a leave type.',
            'from_date.required' => 'Please select the start date.',
            'from_date.after_or_equal' => 'From date cannot be in the past.',
            'to_date.required' => 'Please select the end date.',
            'to_date.after_or_equal' => 'To date must be after or equal to From date.',
            'reason.required' => 'Please enter the reason for leave.',
        ];
    }
}
