<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Path file SQL
        $backupPath1 = base_path('database/backups/sinkadstie-live.sql');
        $backupPath2 = base_path('database/backups/dbaConsole-live.sql');

        // Restore pertama
        if (file_exists($backupPath1)) {
            $sql1 = file_get_contents($backupPath1);
            DB::unprepared($sql1);
        } else {
            throw new \Exception("File backup tidak ditemukan: {$backupPath1}");
        }

        // Restore kedua
        if (file_exists($backupPath2)) {
            $sql2 = file_get_contents($backupPath2);
            DB::unprepared($sql2);
        } else {
            throw new \Exception("File backup tidak ditemukan: {$backupPath2}");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Opsional: drop tabel yang dipulihkan
        DB::unprepared('DROP DATABASE sinkadstie; CREATE DATABASE sinkadstie;');
        DB::unprepared('DROP DATABASE dbaConsole; CREATE DATABASE dbaConsole;');
        // Sesuaikan dengan kebutuhan
    }
};
