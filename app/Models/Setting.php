<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'rate',
        'invoice_email',
        'invoice_address_1',
        'invoice_address_2',
        'invoice_city',
        'invoice_state',
        'invoice_zip',
        'invoice_phone',
        'invoice_note',
        'stripe_public'
    ];

    protected $touches = [
        'user'
    ];

    public function user()
    {
        return $this->belongsTo('Invoicing\Models\User');
    }
}
