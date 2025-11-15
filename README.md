# Application Monitor Agent

Monitors scheduled tasks and queues by pinging the Application Monitor API every 5 minutes.

## Installation

1. Add the site to the Application Monitor application

```bash
composer require twenty20/application-monitor-agent
```

2. Copy and update the below in your .env
3. The scheduled command will run automatically every 5 minutes. This will also dispatch a job to the queue.

```text
APPLICATION_MONITOR_AGENT_ENDPOINT=
APPLICATION_MONITOR_AGENT_SITE_ID=
APPLICATION_MONITOR_AGENT_KEY=
APPLICATION_MONITOR_DEBUGGING_ENABLED=false
```
