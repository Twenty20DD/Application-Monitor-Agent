<?php

namespace Twenty20\ApplicationMonitorAgent\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Twenty20\ApplicationMonitorAgent\Enums\EventType;
use Twenty20\ApplicationMonitorAgent\Http\ApplicationMonitorApi;

class ApplicationMonitorAgentQueueEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        ApplicationMonitorApi::sendEvent(EventType::Queue);
    }
}