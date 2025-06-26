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
        $peserta = DB::connection('mysql')->table('sinkadstie.transaknonkad')
            ->join('sinkadstie.non_akademiks', 'sinkadstie.transaknonkad.id_non', '=', 'sinkadstie.non_akademiks.id')
            ->join('dbaConsole.mahasiswa', 'transaknonkad.id_peserta', '=', 'dbaConsole.mahasiswa.ID')
            ->select('transaknonkad.id','transaknonkad.id_non','transaknonkad.id_peserta', 'dbaConsole.mahasiswa.NAMA', 'sinkadstie.non_akademiks.kegiatan', 'sinkadstie.non_akademiks.kegiatan','sinkadstie.non_akademiks.tglmulai')
            ->get();

        return view ('transaknonakademiks.index', ['peserta' => $peserta]);
    }
    

         
}
