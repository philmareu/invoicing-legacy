<?php

namespace Invoicing\Http\Requests;

use Invoicing\Http\Requests\Request;

class UpdateWorkOrderRequest extends Request
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
            'scheduled' => 'date_format:Y-m-d',
            'reference' => 'required|max:255',
            'description' => '',
            'rate' => 'required|integer'
        ];
    }
}
