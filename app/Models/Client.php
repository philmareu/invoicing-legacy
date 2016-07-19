<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
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
}
