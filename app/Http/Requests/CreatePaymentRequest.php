<?php

namespace Invoicing\Http\Requests;

use Invoicing\Http\Requests\Request;

class CreatePaymentRequest extends Request
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
            'payment_type_id' => 'required|exists:payment_types,id',
            'date' => 'required|date_format:Y-m-d',
            'note' => 'max:255',
            'amount' => 'numeric'
        ];
    }
}
