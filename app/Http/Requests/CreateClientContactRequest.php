<?php

namespace Invoicing\Http\Requests;

use Invoicing\Http\Requests\Request;

class CreateClientContactRequest extends Request
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
            'role' => '',
            'email' => 'email',
            'phone' => '',
            'note' => ''
        ];
    }
}
