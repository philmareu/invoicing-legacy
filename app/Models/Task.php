<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task'
    ];

    protected $touches = [
        'workOrder'
    ];

    public function workOrder()
    {
        return $this->belongsTo('Invoicing\Models\WorkOrder');
    }
}
