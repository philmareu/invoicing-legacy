<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function workOrders()
    {
        return $this->hasMany('Invoicing\Models\WorkOrder');
    }
}
