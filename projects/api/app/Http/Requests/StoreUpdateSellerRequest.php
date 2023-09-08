<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateSellerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => [
                'required',
                'min:3',
                'max:100',
                'unique:seller'
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                'unique:seller'
            ],
            'sales_commission' => [
                'required'
            ]
        ];

        if ($this->method() === 'PUT') {

            $rules = [
                'name' => [
                    'required',
                    'min:3',
                    'max:100',
                    Rule::unique('seller')->ignore($this->id)
                ],
                'email' => [
                    'required',
                    'email',
                    'max:100',
                    Rule::unique('seller')->ignore($this->id)
                ],
                'sales_commission' => [
                    'required'
                ]
            ];
        }

        return $rules;
    }
}
