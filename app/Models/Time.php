<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = [
        'date',
        'time',
        'note'
    ];

    protected $dates = [
        'date'
    ];
}
