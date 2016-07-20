<?php

namespace Invoicing\Console\Commands;

use Illuminate\Console\Command;
use Invoicing\Events\WorkTop\Events\TimeTic;
use Invoicing\Models\Time;

class CheckForTimers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'times:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for timers.';

    protected $time;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Time $time)
    {
        parent::__construct();
        $this->time = $time;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $timers = $this->time->whereNull('time')->first()->load('workOrder');

        foreach($timers as $time)
        {
            event(new TimeTic($time));
        }
    }
}
