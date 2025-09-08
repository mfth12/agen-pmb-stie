<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Path file SQL
        $backupSinkad = base_path('database/backups/sinkadstie-live.sql');
        $backupDbaConsole = base_path('database/backups/dbaConsole-live.sql');

        // Restore ke DB default (sinkadstie)
        if (file_exists($backupSinkad)) {
            $sql1 = file_get_contents($backupSinkad);
            DB::unprepared($sql1);
        } else {
            throw new \Exception("File backup tidak ditemukan: {$backupSinkad}");
        }

        // Restore ke DB tambahan (dbaConsole)
        if (file_exists($backupDbaConsole)) {
            $sql2 = file_get_contents($backupDbaConsole);
            DB::connection('mysql2')->unprepared($sql2);
        } else {
            throw new \Exception("File backup tidak ditemukan: {$backupDbaConsole}");
        }
    }

    public function down(): void
    {
        // Hati-hati, ini akan menghapus semua tabel
        DB::unprepared('DROP DATABASE IF EXISTS sinkadstie; CREATE DATABASE sinkadstie;');
        DB::connection('mysql2')->unprepared('DROP DATABASE IF EXISTS dbaConsole; CREATE DATABASE dbaConsole;');
    }
};
