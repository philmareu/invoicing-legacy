<?php

namespace Invoicing\Http\Requests;

use Invoicing\Http\Requests\Request;

class CreateTimeRequest extends Request
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
            'work_order_id' => 'required|exists:work_orders,id',
            'date' => 'required|date_format:Y-m-d',
            'hours' => 'required|integer',
            'minutes' => 'required|integer|min:0|max:59',
            'note' => 'max:255'
        ];
    }
}
