<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

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

        // Perintah restore
        $cmd1 = "pv {$backupPath1} | docker exec -i ctpegawai-database mysql -u root -psatuduatiga456TujuhDelapan9 sinkadstie";
        $cmd2 = "pv {$backupPath2} | docker exec -i ctpegawai-database mysql -u root -psatuduatiga456TujuhDelapan9 dbaConsole";

        // Jalankan command
        exec($cmd1, $output1, $status1);
        exec($cmd2, $output2, $status2);

        if ($status1 !== 0 || $status2 !== 0) {
            throw new \Exception("Gagal restore database dari file backup");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optional: drop database atau kosongkan tabel
        // exec("docker exec -i ctpegawai-database mysql -u root -psatuduatiga456TujuhDelapan9 -e 'DROP DATABASE sinkadstie; CREATE DATABASE sinkadstie;'");
        // exec("docker exec -i ctpegawai-database mysql -u root -psatuduatiga456TujuhDelapan9 -e 'DROP DATABASE dbaConsole; CREATE DATABASE dbaConsole;'");
        // docker exec -i ctpegawai-database mysql -u root -psatuduatiga456TujuhDelapan9 -e 'DROP DATABASE sinkadstie; CREATE DATABASE sinkadstie;' && docker exec -i ctpegawai-database mysql -u root -psatuduatiga456TujuhDelapan9 -e 'DROP DATABASE dbaConsole; CREATE DATABASE dbaConsole;'
    }
};
