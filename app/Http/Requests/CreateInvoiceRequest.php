<?php

namespace Invoicing\Http\Requests;

use Invoicing\Http\Requests\Request;

class CreateInvoiceRequest extends Request
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
            'client_id' => 'required|exists:clients,id',
            'description' => '',
            'due' => 'date_format:Y-m-d'
        ];
    }
}
