<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds for sistem non-akademik.
     * 
     * @return void
     */
    public function run(): void
    {
        //seed data dasar
        $this->call(KonfigurasiTableSeeder::class);
        $this->call(RolePermissionSeeder::class);
    }
}
