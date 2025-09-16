<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Sistem\KonfigurasiModel;

class KonfigurasiTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $tableName = KonfigurasiModel::getTableName();
    DB::statement("DELETE FROM $tableName");
    DB::statement("ALTER TABLE $tableName AUTO_INCREMENT = 1011;");


    DB::table($tableName)->insert([
      // 'id'            => "101",
      'config_group'  => 'identitas',
      'config_key'    => 'NAMA_PT',
      'config_value'  => 'STIE Pembangunan Tanjungpinang',
      'created_at'    => Carbon::now(),
      'updated_at'    => Carbon::now()
    ]);

    DB::table($tableName)->insert([
      // 'id'            => "102",
      'config_group'  => 'identitas',
      'config_key'    => 'NAMA_PT_ALIAS',
      'config_value'  => 'STIE',
      'created_at'    => Carbon::now(),
      'updated_at'    => Carbon::now()
    ]);

    DB::table($tableName)->insert([
      // 'id'            => "103",
      'config_group'  => 'identitas',
      'config_key'    => 'NAMA_SISTEM',
      'config_value'  => 'Sistem Informasi Non-Akademik',
      'created_at'    => Carbon::now(),
      'updated_at'    => Carbon::now()
    ]);
    
    DB::table($tableName)->insert([
      // 'id'            => "103",
      'config_group'  => 'identitas',
      'config_key'    => 'NAMA_SISTEM_ALIAS',
      'config_value'  => 'Sinkad',
      'created_at'    => Carbon::now(),
      'updated_at'    => Carbon::now()
    ]);

    DB::table($tableName)->insert([
      // 'id'            => "104",
      'config_group'  => 'identitas',
      'config_key'    => 'LOGO',
      'config_value'  => '{realpath:"/public/logo-main.png",relativepath:"logo-main.png"}',
      'created_at'    => Carbon::now(),
      'updated_at'    => Carbon::now()
    ]);

    DB::table($tableName)->insert([
      // 'id'            => "201",
      'config_group'  => 'basic',
      'config_key'    => 'DEFAULT_TA',
      'config_value'  => date('Y'),
      'created_at'    => Carbon::now(),
      'updated_at'    => Carbon::now()
    ]);

    DB::table($tableName)->insert([
      // 'id'            => "202",
      'config_group'  => 'basic',
      'config_key'    => 'DEFAULT_SEMESTER',
      'config_value'  => 1,
      'created_at'    => Carbon::now(),
      'updated_at'    => Carbon::now()
    ]);

    // DB::table($tableName)->insert([
    //   // 'id'            => "203",
    //   'config_group'  => 'basic',
    //   'config_key'    => 'DEFAULT_TAHUN_PENDAFTARAN',
    //   'config_value'  => date('Y'),
    //   'created_at'    => Carbon::now(),
    //   'updated_at'    => Carbon::now()
    // ]);

    // DB::table($tableName)->insert([
    //   // 'id'            => "204",
    //   'config_group'  => 'basic',
    //   'config_key'    => 'DEFAULT_SEMESTER_PENDAFTARAN',
    //   'config_value'  => 1,
    //   'created_at'    => Carbon::now(),
    //   'updated_at'    => Carbon::now()
    // ]);

    // DB::table($tableName)->insert([
    //   // 'id'            => "205",
    //   'config_group'  => 'basic',
    //   'config_key'    => 'DEFAULT_PRODI',
    //   'config_value'  => 1000,
    //   'created_at'    => Carbon::now(),
    //   'updated_at'    => Carbon::now()
    // ]);

    // DB::table($tableName)->insert([
    //   // 'id'            => "206",
    //   'config_group'  => 'basic',
    //   'config_key'    => 'DEFAULT_FEEDER_TA',
    //   'config_value'  => date('Y'),
    //   'created_at'    => Carbon::now(),
    //   'updated_at'    => Carbon::now()
    // ]);

    // DB::table($tableName)->insert([
    //   // 'id'            => "207",
    //   'config_group'  => 'basic',
    //   'config_key'    => 'DEFAULT_FEEDER_SEMESTER',
    //   'config_value'  => 1,
    //   'created_at'    => Carbon::now(),
    //   'updated_at'    => Carbon::now()
    // ]);

    // DB::table($tableName)->insert([
    //   // 'id'            => "208",
    //   'config_group'  => 'basic',
    //   'config_key'    => 'DEFAULT_KKN_MINIMAL_SKS',
    //   'config_value'  => 130,
    //   'created_at'    => Carbon::now(),
    //   'updated_at'    => Carbon::now()
    // ]);

    // DB::table($tableName)->insert([
    //   // 'id'            => "209",
    //   'config_group'  => 'basic',
    //   'config_key'    => 'DEFAULT_KODE_MAKUL_KKN',
    //   'config_value'  => '{"1000":"EPB403","1001":"EMK401"}',
    //   'created_at'    => Carbon::now(),
    //   'updated_at'    => Carbon::now()
    // ]);

    // // spmb
    // DB::table($tableName)->insert([
    //   // 'id'            => "301",
    //   'config_group'  => 'spmb',
    //   'config_key'    => 'DEFAULT_PASSING_GRADE',
    //   'config_value'  => 14,
    //   'created_at'    => Carbon::now(),
    //   'updated_at'    => Carbon::now()
    // ]);

    // // report
    // DB::table($tableName)->insert([
    //   // 'id'            => "701",
    //   'config_group'  => 'report',
    //   'config_key'    => 'HEADER_1',
    //   'config_value'  => '',
    //   'created_at'    => Carbon::now(),
    //   'updated_at'    => Carbon::now()
    // ]);

    //blog
    DB::table($tableName)->insert([
      // 'id'            => "601",
      'config_group'  => 'blog',
      'config_key'    => 'APPEARANCE',
      'config_value'  => json_encode([
        'headers'     => [
          'logo'        => 'storage/blog/headers/logo.png',
        ],
      ]),
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now()
    ]);

    DB::table($tableName)->insert([
      // 'id'            => "602",
      'config_group'  => 'blog',
      'config_key'    => 'PAGES',
      'config_value'  => json_encode([
        'contact'       => [
          'title'       => 'Hubungi Kami',
          'content'     => '<ul><li>Lorem</li></ul>',
          'files'       => '',
          'whatsapp'    => '',
          'telegram'    => '',
          'facebook'    => '',
          'instagram'   => '',
          'x'           => '',
          'youtube'     => '',
          'linkedin'    => '',
        ],
        'informasi_pendaftaran' => [
          'title'       => 'Informasi Pendaftaran',
          'content'     => '<ul><li>Lorem</li></ul>',
          'files'       => '',
        ],
      ]),
      'created_at'    => Carbon::now(),
      'updated_at'    => Carbon::now()
    ]);

    DB::table($tableName)->insert([
      // 'id'            => "702",
      'config_group'  => 'report',
      'config_key'    => 'HEADER_2',
      'config_value'  => null,
      'created_at'    => Carbon::now(),
      'updated_at'    => Carbon::now()
    ]);

    // DB::table($tableName)->insert([
    //   // 'id'            => "703",
    //   'config_group'  => 'report',
    //   'config_key'    => 'HEADER_3',
    //   'config_value'  => '',
    //   'created_at'    => Carbon::now(),
    //   'updated_at'    => Carbon::now()
    // ]);

    // DB::table($tableName)->insert([
    //   // 'id'            => "704",
    //   'config_group'  => 'report',
    //   'config_key'    => 'HEADER_4',
    //   'config_value'  => '',
    //   'created_at'    => Carbon::now(),
    //   'updated_at'    => Carbon::now()
    // ]);

    // DB::table($tableName)->insert([
    //   // 'id'            => "705",
    //   'config_group'  => 'report',
    //   'config_key'    => 'HEADER_ADDRESS',
    //   'config_value'  => '',
    //   'created_at'    => Carbon::now(),
    //   'updated_at'    => Carbon::now()
    // ]);

    // //server
    // DB::table($tableName)->insert([
    //   // 'id'            => "901",
    //   'config_group'  => 'server',
    //   'config_key'    => 'CAPTCHA_SITE_KEY',
    //   'config_value'  => '$',
    //   'created_at'    => Carbon::now(),
    //   'updated_at'    => Carbon::now()
    // ]);

    // DB::table($tableName)->insert([
    //   // 'id'            => "902",
    //   'config_group'  => 'server',
    //   'config_key'    => 'CAPTCHA_PRIVATE_KEY',
    //   'config_value'  => '$',
    //   'created_at'    => Carbon::now(),
    //   'updated_at'    => Carbon::now()
    // ]);

    DB::table($tableName)->insert([
      // 'id'            => "903",
      'config_group'  => 'server',
      'config_key'    => 'TOKEN_TTL_EXPIRE',
      'config_value'  => '60', //minute
      'created_at'    => Carbon::now(),
      'updated_at'    => Carbon::now()
    ]);
    
    DB::table($tableName)->insert([
      // 'id'            => "903",
      'config_group'  => 'server',
      'config_key'    => 'WA_ENDPOINT',
      'config_value'  => 'https://wa.stie-pembangunan.ac.id', //url
      'created_at'    => Carbon::now(),
      'updated_at'    => Carbon::now()
    ]);
    
    DB::table($tableName)->insert([
      // 'id'            => "903",
      'config_group'  => 'server',
      'config_key'    => 'WA_SESSION',
      'config_value'  => 'pegawai7d62jfrwplus', //secret session
      'created_at'    => Carbon::now(),
      'updated_at'    => Carbon::now()
    ]);

    KonfigurasiModel::toCache();
  }
}
