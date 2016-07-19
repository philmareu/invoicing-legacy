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

    public function invoice()
    {
        return $this->belongsTo('Invoicing\Models\Invoice');
    }

    public function getAmountAttribute($value)
    {
        return $this->converToDollars($value);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = (int) round($value * 100);
    }

    private function converToDollars($cents)
    {
        return $cents / 100;
    }
}
