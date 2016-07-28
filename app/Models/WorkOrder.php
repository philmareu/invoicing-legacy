<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    protected $fillable = [
        'reference',
        'scheduled',
        'description',
        'rate',
        'completed'
    ];

    protected $dates = [
        'scheduled'
    ];

    protected $touches = [
        'invoice'
    ];

    public function tasks()
    {
        return $this->hasMany('Invoicing\Models\Task');
    }

    public function times()
    {
        return $this->hasMany('Invoicing\Models\Time');
    }

    public function notes()
    {
        return $this->morphMany('Invoicing\Models\Note', 'subject');
    }

    public function invoice()
    {
        return $this->belongsTo('Invoicing\Models\Invoice');
    }

    public function client()
    {
        return $this->invoice->client();
    }

    public function uncompletedTasks()
    {
        return $this->tasks()->whereNull('completed_at');
    }

    public function completedTasks()
    {
        return $this->tasks()->whereNotNull('completed_at');
    }

    public function totalTime()
    {
        return $this->times->sum('time');
    }

    public function totalTimeHours()
    {
        // round up to nearest tenth
        return ceil(($this->totalTime() / 60) * 10) / 10;
    }

    public function amount()
    {
        return $this->totalTimeHours() * ($this->rate * 100);
    }
}
