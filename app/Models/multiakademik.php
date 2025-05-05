<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class multiakademik extends Model
{
 //
 use HasFactory;

 /**
  * fillable
  *
  * @var array
  */
  //sambungkan ke mysql
 protected $connection = 'mysql';
 protected $table = 'transaknonkad';
 protected $fillable = [
     'id_non',
     'id_peserta',
     'kode_bayar',
     'status_bayar',
     'nilai',
     'lulus',
     'no_sertifikat',
     'file_sertifikat',
     
 ];

 public function roles()
{
    return $this->belongsToMany(multiakademik::class, 'transaknonkad');
}
}
