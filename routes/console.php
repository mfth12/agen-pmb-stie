<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

$password = env('DB_PASSWORD');

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
