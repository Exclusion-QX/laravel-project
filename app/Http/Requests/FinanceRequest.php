<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinanceRequest extends FormRequest
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
            'income' => 'integer|nullable',
            'forced_expenses' => 'integer|nullable',
            'expenses' => 'integer|nullable',
            'saving' => 'integer|nullable',
        ];
    }
}
