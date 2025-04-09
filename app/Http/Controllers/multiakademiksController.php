<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import return type View
use Illuminate\View\View;

use Illuminate\Support\Facades\DB;

class multiakademiksController extends Controller
{
    //
    public function index()
    { 
       
        $peserta = DB::table('sinkad-stiepem.transaknonkad') 
            ->join('sinkad-stiepem.non_akademiks', 'sinkad-stiepem.transaknonkad.id_non', '=', 'sinkad-stiepem.non_akademiks.id')
            ->join('dba.mahasiswa', 'sinkad-stiepem.transaknonkad.id_peserta', '=', 'dba.mahasiswa.ID')
            ->select('sinkad-stiepem.transaknonkad.id','sinkad-stiepem.transaknonkad.id_non','sinkad-stiepem.transaknonkad.id_peserta', 'dba.mahasiswa.NAMA', 'dba.mahasiswa.STATUS', 'sinkad-stiepem.non_akademiks.kegiatan')
            ->get();

        // dd($peserta);
        return view ('transaknonakademiks.registerkegiatan', ['peserta' => $peserta]);
    }
    
    public function create(): View
    {
        $peserta = DB::table('sinkad-stiepem.non_akademiks') 
        // ->join('sinkad-stiepem.non_akademiks', 'sinkad-stiepem.transaknonkad.id_non', '=', 'sinkad-stiepem.non_akademiks.id')
        // ->join('dba.mahasiswa', 'sinkad-stiepem.transaknonkad.id_peserta', '=', 'dba.mahasiswa.ID')
        ->select('sinkad-stiepem.non_akademiks.id','sinkad-stiepem.non_akademiks.kegiatan')
        ->where('sinkad-stiepem.non_akademiks.statusopen', '1')
        ->get();
        
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
        multiakademiksController::create([
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
}
