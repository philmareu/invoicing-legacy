<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function workOrders()
    {
        return $this->hasMany('Invoicing\Models\WorkOrder');
    }

    public function notes()
    {
        return $this->morphMany('Invoicing\Models\Note', 'subject');
    }

    public function items()
    {
        return $this->hasMany('Invoicing\Models\InvoiceItem');
    }
}
