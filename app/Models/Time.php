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

    public function workOrder()
    {
        return $this->belongsTo('Invoicing\Models\WorkOrder');
    }

    public function elapsed()
    {
        return is_null($this->time) ? $this->start->diffInMinutes() : $this->time;
    }

    public function elapsedFormatted()
    {
        $timeInMinutes = $this->elapsed();
        $hours = floor($timeInMinutes / 60);
        $minutes = $timeInMinutes - ($hours * 60);

        return sprintf('%1d:%02d', $hours, $minutes);
    }
}
