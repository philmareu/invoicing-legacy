<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    public function tasks()
    {
        return $this->hasMany('Invoicing\Models\Task');
    }

    public function times()
    {
        return $this->hasMany('Invoicing\Models\Time');
    }
}
