<?php

namespace Twenty20\ApplicationMonitorAgent\Console;

use Illuminate\Console\Command;
use Twenty20\ApplicationMonitorAgent\Enums\EventType;
use Twenty20\ApplicationMonitorAgent\Http\ApplicationMonitorApi;
use Twenty20\ApplicationMonitorAgent\Jobs\ApplicationMonitorAgentQueueEvent;

class SendSchedulerEvent extends Command
{
    protected $signature = 'application-monitor-agent:run-agent';
    protected $description = 'Run the Application Monitor Agent';

    public function handle()
    {
        ApplicationMonitorApi::sendEvent(EventType::Scheduler);

        ApplicationMonitorAgentQueueEvent::dispatch();

        $this->info('Application Monitor Agent run successfully.');
    }
}