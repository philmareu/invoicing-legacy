<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function type()
    {
        return $this->belongsTo('Invoicing\Models\PaymentType');
    }
}
