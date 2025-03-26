<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class TransaksiNonAkademik extends Model
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
}
