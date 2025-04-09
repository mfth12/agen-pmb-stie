<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class multiakademiks extends Model
{
    //
     //
     use HasFactory;

     /**
      * fillable
      *
      * @var array
      */
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
        return $this->belongsToMany(multiakademiks::class, 'transaknonkad');
    }
}
