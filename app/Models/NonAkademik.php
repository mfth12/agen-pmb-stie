<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonAkademik extends Model
{
    //
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'kegiatan',
        'kategori',
        'ta',
        'semester',
        'tglmulai',
        'tglselesai',
        'biaya',
        'tot_penerimaan',
        'tot_pengeluaran',
        'narsum',
        'id_penyelenggara',
        'penyelenggara',
        'jml_peserta',
        'noser',
        'skpi',
        'statusopen',
        // 'brosur'=>'required|image|mimes:jpeg,jpg,png,bmp,gif,svg',
        'brosur',
    ];

    public function roles()
    {
        return $this->belongsToMany(NonAkademik::class, 'transaknonkad');
    }
}
