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
    $konfigs = KonfigurasiModel::all()->pluck('config_value', 'config_key')->toArray();
    Cache::put('konfigs', $konfigs);
  }

  /**
   * digunakan untuk  memanggil data cache.
   *
   */
  public static function getCache($idx = null)
  {
    if (!Cache::has('konfigs')) {
      KonfigurasiModel::toCache();
    }

    if ($idx == null) {
      return Cache::get('konfigs');
    } else {
      $konfigs = Cache::get('konfigs');
      return $konfigs[$idx];
    }
  }

  /**
   * digunakan untuk  melakukan refresh cache.
   *
   */
  public static function refreshCache()
  {
    Cache::forget('konfigs');
    Cache::rememberForever('konfigs', function () {
      return self::pluck('config_value', 'config_key');
    });
  }

  /**
   * digunakan untuk menghapus seluruh cache.
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
