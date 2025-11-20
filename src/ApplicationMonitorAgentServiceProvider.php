<?php

namespace Twenty20\ApplicationMonitorAgent;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Twenty20\ApplicationMonitorAgent\Console\SendSchedulerEvent;

class ApplicationMonitorAgentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/application-monitor-agent.php', 'application-monitor-agent');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/application-monitor-agent.php' => config_path('application-monitor-agent.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                SendSchedulerEvent::class,
            ]);
        }

        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            $schedule
                ->command('application-monitor-agent:run-agent')
                ->onOneServer()
                ->withoutOverlapping()
                ->everyFiveMinutes()
                ->runInBackground();
        });
    }
}
