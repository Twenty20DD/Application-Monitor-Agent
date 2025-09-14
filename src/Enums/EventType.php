<?php

namespace Twenty20\ApplicationMonitorAgent\Enums;

enum EventType: string
{
    case Queue = 'Queue';
    case Scheduler = 'Scheduler';
}
