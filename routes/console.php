<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

$password = env('DB_PASSWORD');

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Artisan::command('cleandb', function () use ($password) {
//     exec("docker exec -i ctpegawai-database mysql -u root -p{$password} -e 'DROP DATABASE sinkadstie; CREATE DATABASE sinkadstie;'");
//     exec("docker exec -i ctpegawai-database mysql -u root -p{$password} -e 'DROP DATABASE dbaConsole; CREATE DATABASE dbaConsole;'");
// })->purpose('Menghapus seluruh database');
