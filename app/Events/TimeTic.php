<?php

namespace Invoicing\Events;

use Invoicing\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Invoicing\Models\Time;

class TimeTic extends Event implements ShouldBroadcast
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
            'workOrderId' => $this->time->work_order_id
        ];
    }

    private function getFormattedTimer(Time $time)
    {
        $timeInMinutes = $time->elapsed();
        $hours = floor($timeInMinutes / 60);
        $minutes = $timeInMinutes - ($hours * 60);

        return sprintf('%1d:%02d', $hours, $minutes);
    }
}
