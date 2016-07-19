<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = [
        'start',
        'time',
        'note'
    ];

    protected $dates = [
        'start'
    ];
}
