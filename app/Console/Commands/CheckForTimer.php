<?php

namespace Invoicing\Console\Commands;

use Illuminate\Console\Command;
use Invoicing\Events\TimeTic;
use Invoicing\Models\Time;

class CheckForTimer extends Command
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
        $time = $this->time->with('workOrder')->whereNull('time')->first();

        if(! is_null($time)) event(new TimeTic($time));
    }
}
