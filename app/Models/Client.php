<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'title',
        'address_1',
        'address_2',
        'city',
        'state',
        'zip',
        'phone',
        'invoicing_email'
    ];

    public function invoices()
    {
        return $this->hasMany('Invoicing\Models\Invoice');
    }

    public function notes()
    {
        return $this->morphMany('Invoicing\Models\Note', 'subject');
    }

    public function contacts()
    {
        return $this->hasMany('Invoicing\Models\ClientContact');
    }

    public function workOrders()
    {
        return $this->hasManyThrough('Invoicing\Models\WorkOrder', 'Invoicing\Models\Invoice');
    }
}
