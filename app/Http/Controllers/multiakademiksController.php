<?php

namespace App\Http\Controllers;
use App\Models\multiakademik;
use Illuminate\Http\Request;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import return type View
use Illuminate\View\View;


use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

class multiakademiksController extends Controller
{
    //
    public function index()
    { 
       //nama tabel baru dbaConsole & sinkadstie
       //DB::connection('mysql2')->table('mahasiswa')
        $peserta = DB::connection('mysql')->table('sinkadstie.transaknonkad') 
            ->join('sinkadstie.non_akademiks', 'sinkadstie.transaknonkad.id_non', '=', 'sinkadstie.non_akademiks.id')
            ->join('dbaConsole.mahasiswa', 'sinkadstie.transaknonkad.id_peserta', '=', 'dbaConsole.mahasiswa.ID')
            ->select('sinkadstie.transaknonkad.id','sinkadstie.transaknonkad.id_non','sinkadstie.transaknonkad.id_peserta', 'dbaConsole.mahasiswa.NAMA', 'dbaConsole.mahasiswa.STATUS', 'sinkadstie.non_akademiks.kegiatan',('sinkadstie.non_akademiks.tglmulai'))
            // ->where ('sinkad-stiepem.transaknonkad.id_peserta','$nim')
            ->get();

        // dd($peserta);
        return view ('transaknonakademiks.registerkegiatan', ['peserta' => $peserta]);
    }
    
    public function create(): View
    {
        $peserta = DB::table('sinkadstie.non_akademiks') 
        ->select('non_akademiks.id','non_akademiks.kegiatan','non_akademiks.kategori','non_akademiks.tglmulai','non_akademiks.biaya','non_akademiks.skpi')
        ->where('sinkadstie.non_akademiks.statusopen', '1') //0=tdk aktif(default), 1=open, 2=selesai
        ->get();
        
        //  $peserta = DB::table('sinkad-stiepem.transaknonkad') 
        // // ->join('sinkad-stiepem.non_akademiks', 'sinkad-stiepem.transaknonkad.id_non', '=', 'sinkad-stiepem.non_akademiks.id')
        // // ->join('dba.mahasiswa', 'sinkad-stiepem.transaknonkad.id_peserta', '=', 'dba.mahasiswa.ID')
        // ->select('sinkad-stiepem.transaknonkad.id','sinkad-stiepem.transaknonkad.id_non')
        // // ->where('sinkad-stiepem.non_akademiks.statusopen', '1') //0=tdk aktif(default), 1=open, 2=selesai
        // ->get();


        // dd($peserta);
        return view('transaknonakademiks.createtransakademiks', ['peserta' => $peserta]);
    }

    
    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form => kolom harus konsisten dengan di Model
        
        $request->validate([
            'id_non'         => 'required|numeric', //nomor nanti nama dan biaya kegiatan muncul
            'id_peserta'     => 'required|min:8', //nim, nanti nama mahasiswa otomatis muncul
            'kode_bayar'     => 'required|min:4',
            'status_bayar'   => 'required|numeric',
            // 'required|image|mimes:jpeg,jpg,png|max:2048',
            // 'semester'         => 'required|min:4',
            // 'biaya'         => 'required|numeric'
        ]);

        //upload image
        // $brosur = $request->file('brosur');
        // $brosur->storeAs('/storage/app/public/image', $brosur->hashName());
        // $brosur->storeAs('public/brosurs', $brosur->hashName());

        //create product
        multiakademik::create([         //insert ke nama tabel
            'id_non'      => $request->id_non,
            'id_peserta'  => $request->id_peserta,
            'kode_bayar'  => $request->kode_bayar,
            'status_bayar'=>  $request->status_bayar,
            // 'semester'  => $request->semester,
            // 'biaya'     => $request->biaya
        ]);

        //redirect to index
        return redirect()->route('multiakademik.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function sertifikatup(): View
    {
        $peserta = DB::table('sinkadstie.transaknonkad') 
        ->join('sinkadstie.non_akademiks', 'sinkadstie.transaknonkad.id_non', '=', 'sinkadstie.non_akademiks.id')
        ->join('dbaConsole.mahasiswa', 'sinkadstie.transaknonkad.id_peserta', '=', 'dbaConsole.mahasiswa.ID')
        ->select('sinkadstie.transaknonkad.id','sinkadstie.transaknonkad.id_non','sinkadstie.transaknonkad.id_peserta','sinkadstie.transaknonkad.kode_bayar','sinkadstie.transaknonkad.status_bayar','sinkadstie.transaknonkad.nilai','sinkadstie.transaknonkad.lulus','sinkadstie.transaknonkad.no_sertifikat','sinkadstie.transaknonkad.file_sertifikat')
        ->get();
        // ->where ('sinkad-stiepem.transaknonkad.id_peserta',$nimLogin)
        
        return view('transaknonakademiks.uploadsertifikat', ['peserta' => $peserta]);
    }

    
}
