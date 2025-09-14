<?php

namespace Twenty20\ApplicationMonitorAgent;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Twenty20\ApplicationMonitorAgent\Console\SendSchedulerEvent;

class ApplicationMonitorAgentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/application-monitor-agent.php', 'application-monitor-agent');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/application-monitor-agent.php' => config_path('application-monitor-agent.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                SendSchedulerEvent::class,
            ]);
        }

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('application-monitor-agent:run-agent')->everyFiveMinutes();
        });
    }
}
