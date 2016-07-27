<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class ClientContact extends Model
{
    protected $fillable = [
        'name',
        'role',
        'email',
        'phone',
        'note'
    ];

    protected $touches = [
        'client'
    ];

    public function client()
    {
        return $this->belongsTo('Invoicing\Models\Client');
    }
}
