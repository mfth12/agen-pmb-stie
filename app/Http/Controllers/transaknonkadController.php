<?php

namespace App\Http\Controllers;
//import return type View
use Illuminate\View\View;

use Illuminate\Support\Facades\DB;

class transaknonkadController extends Controller
{
    //
    //untuk http://localhost:8000/transaknonakademiks(index)
    /**
     * index
     *
     * @return void
     */
    public function index()
    {            
        $peserta = DB::table('transaknonkad')
            ->join('non_akademiks', 'transaknonkad.id_non', '=', 'non_akademiks.id')
            ->join('mahasiswa', 'transaknonkad.id_peserta', '=', 'mahasiswa.ID')
            ->select('transaknonkad.id','transaknonkad.id_non','transaknonkad.id_peserta', 'mahasiswa.NAMA', 'non_akademiks.kegiatan', 'non_akademiks.kegiatan','non_akademiks.tglmulai')
            ->get();

        return view ('transaknonakademiks.index', ['peserta' => $peserta]);
    }
    

         
}
