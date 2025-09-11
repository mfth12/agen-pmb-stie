<?php

namespace App\Models\Sistem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class KonfigurasiModel extends Model
{
  /**
   * nama tabel model ini.
   *
   * @var string
   */
  protected $table = 'konfigurasis';
  /**
   * primary key tabel ini.
   *
   * @var string
   */
  protected $primaryKey = 'id';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'config_group',
    'config_key',
    'config_value',
    'value_1',
    'value_2',
    'value_3',
    'value_4',
    'value_5'
  ];

  /**
   * enable auto_increment.
   *
   * @var string
   */
  public $incrementing = false;

  /**
   * activated timestamps.
   *
   * @var string
   */
  public $timestamps = true;

  /**
   * digunakan untuk  menyimpan ke cache.
   *
   */
  public static function toCache()
  {
    $config = KonfigurasiModel::all()->pluck('config_value', 'config_key');
    Cache::put('config', $config);
  }
  public static function getCache($idx = null)
  {
    if (!Cache::has('config')) {
      KonfigurasiModel::toCache();
    }

    if ($idx == null) {
      return Cache::get('config');
    } else {
      $config = Cache::get('config');
      return $config[$idx];
    }
  }
  /**
   * digunakan untuk menghapus cache.
   *
   */
  public static function clear()
  {
    Cache::flush();
  }

  /**
   * digunakan untuk mengambil nama tabel model ini.
   *
   * @return string
   */
  public static function getTableName()
  {
    return with(new static)->getTable();
  }
}
