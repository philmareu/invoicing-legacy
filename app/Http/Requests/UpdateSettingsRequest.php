<?php

namespace Invoicing\Http\Requests;

use Invoicing\Http\Requests\Request;

class UpdateSettingsRequest extends Request
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'min:6',
            'image' => 'image',
            'rate' => 'required|integer',
            'invoice_email' => 'max:255',
            'invoice_address_1' => 'max:255',
            'invoice_address_2' => 'max:255',
            'invoice_city' => 'max:255',
            'invoice_state' => 'max:255',
            'invoice_zip' => 'max:255',
            'invoice_phone' => 'max:255',
            'invoice_note' => '',
            'stripe_public' => '',
            'stripe_secret' => ''
        ];
    }
}
