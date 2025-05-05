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
       
        $peserta = DB::table('sinkad-stiepem.transaknonkad') 
            ->join('sinkad-stiepem.non_akademiks', 'sinkad-stiepem.transaknonkad.id_non', '=', 'sinkad-stiepem.non_akademiks.id')
            ->join('dba.mahasiswa', 'sinkad-stiepem.transaknonkad.id_peserta', '=', 'dba.mahasiswa.ID')
            ->select('sinkad-stiepem.transaknonkad.id','sinkad-stiepem.transaknonkad.id_non','sinkad-stiepem.transaknonkad.id_peserta', 'dba.mahasiswa.NAMA', 'dba.mahasiswa.STATUS', 'sinkad-stiepem.non_akademiks.kegiatan')
            // ->where ('sinkad-stiepem.transaknonkad.id_peserta','$nim')
            ->get();

        // dd($peserta);
        return view ('transaknonakademiks.registerkegiatan', ['peserta' => $peserta]);
    }
    
    public function create(): View
    {
        $peserta = DB::table('sinkad-stiepem.non_akademiks') 
        ->select('non_akademiks.id','non_akademiks.kegiatan','non_akademiks.kategori','non_akademiks.tglmulai','non_akademiks.biaya','non_akademiks.skpi')
        ->where('sinkad-stiepem.non_akademiks.statusopen', '1') //0=tdk aktif(default), 1=open, 2=selesai
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
        $peserta = DB::table('sinkad-stiepem.transaknonkad') 
        ->join('sinkad-stiepem.non_akademiks', 'sinkad-stiepem.transaknonkad.id_non', '=', 'sinkad-stiepem.non_akademiks.id')
        ->join('dba.mahasiswa', 'sinkad-stiepem.transaknonkad.id_peserta', '=', 'dba.mahasiswa.ID')
        ->select('sinkad-stiepem.transaknonkad.id','sinkad-stiepem.transaknonkad.id_non','sinkad-stiepem.transaknonkad.id_peserta','sinkad-stiepem.transaknonkad.kode_bayar','sinkad-stiepem.transaknonkad.status_bayar','sinkad-stiepem.transaknonkad.nilai','sinkad-stiepem.transaknonkad.lulus','sinkad-stiepem.transaknonkad.no_sertifikat','sinkad-stiepem.transaknonkad.file_sertifikat')
        ->get();
        // ->where ('sinkad-stiepem.transaknonkad.id_peserta',$nimLogin)
        
        return view('transaknonakademiks.uploadsertifikat', ['peserta' => $peserta]);
    }

    
}
