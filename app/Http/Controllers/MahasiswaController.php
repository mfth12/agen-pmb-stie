<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import return type View
use Illuminate\View\View;

use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    //
    public function index()
    {            
        $mahasiswa = DB::connection('mysql2')->table('mahasiswa')
        ->select('mahasiswa.ID','mahasiswa.NAMA','mahasiswa.IDPRODI', 'mahasiswa.SKS', 'mahasiswa.STATUS')
        ->where('mahasiswa.STATUS', 'A')
        ->orderBy('ID','asc')
        // ->orderBy('SKS','desc')
        ->get();
       
        return view ('transaknonakademiks.mahasiswa', ['mahasiswa' => $mahasiswa]);
    }
}
