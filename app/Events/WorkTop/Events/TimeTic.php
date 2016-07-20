<?php

namespace Invoicing\Events\WorkTop\Events;

use Carbon\Carbon;
use Invoicing\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Invoicing\Models\Time;

class TimeTic extends Event
{
    use SerializesModels;

    public $time;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Time $time)
    {
        $this->time = $time->load('workOrder');
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['invoicing'];
    }

    public function broadcastWith()
    {
        return [
            'timer' => $this->getFormattedTimer($this->time),
            'workId' => $this->time->work_id
        ];
    }

    private function getFormattedTimer(Time $time)
    {
        $totalMinutes = Carbon::createFromFormat('Y-m-d H:i:s', $time->start)->diffInMinutes();
        $hours = intval($totalMinutes / 60);
        $minutes = intval($totalMinutes - ($hours * 60));

        return sprintf('%1d:%02d', $hours, $minutes);
    }
}
