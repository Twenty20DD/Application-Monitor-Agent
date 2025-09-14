<?php

namespace Twenty20\ApplicationMonitorAgent\Http;

use Illuminate\Support\Facades\Http;
use Twenty20\ApplicationMonitorAgent\Enums\EventType;

class ApplicationMonitorApi
{
    public static function sendEvent(EventType $eventType): void
    {
        if(empty(config('application-monitor-agent.site_id'))) {
            return;
        }

        if(empty(config('application-monitor-agent.key'))) {
            return;
        }

        if(empty(config('application-monitor-agent.endpoint'))) {
            return;
        }

        $url = rtrim(config('application-monitor-agent.endpoint'), '/');

        if($eventType === EventType::Scheduler) {
            $url .= '/scheduler-event';
        }

        if($eventType === EventType::Queue) {
            $url .= '/queue-event';
        }

        Http::post($url, [
            'site_id' => config('application-monitor-agent.site_id'),
            'key' => config('application-monitor-agent.key'),
        ]);
    }
}