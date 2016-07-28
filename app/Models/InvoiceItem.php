<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id',
        'item',
        'amount'
    ];

    protected $touches = [
        'invoice'
    ];

    public function invoice()
    {
        return $this->belongsTo('Invoicing\Models\Invoice');
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = (int) round($value * 100);
    }
}
