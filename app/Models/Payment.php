<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payment_type_id',
        'date',
        'note',
        'amount'
    ];

    protected $dates = [
        'date'
    ];

    public function type()
    {
        return $this->belongsTo('Invoicing\Models\PaymentType', 'payment_type_id');
    }

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
