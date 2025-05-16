<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:test-command')
    ->everyMinute()
    ->withoutOverlapping();
