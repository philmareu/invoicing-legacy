<?php

namespace Invoicing\Http\Requests;

use Invoicing\Http\Requests\Request;

class CreateClientRequest extends Request
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
            'title' => 'required|max:255|unique:clients',
            'address_1' => 'max:255',
            'address_2' => 'max:255',
            'city' => 'max:255',
            'state' => 'size:2',
            'zip' => 'max:10',
            'phone' => 'max:15',
            'invoicing_email' => 'required|email|max:255'
        ];
    }
}
