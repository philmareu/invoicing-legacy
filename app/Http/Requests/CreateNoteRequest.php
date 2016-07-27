<?php

namespace Invoicing\Http\Requests;

use Invoicing\Http\Requests\Request;

class CreateNoteRequest extends Request
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
            'resource_id' => 'required|integer',
            'resource_model' => 'required',
            'note' => 'required'
        ];
    }
}
