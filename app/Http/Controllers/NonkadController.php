<?php

namespace App\Http\Controllers;
use App\Models\NonAkademik;
use Illuminate\Http\Request;

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facades Storage: terkait penghapusan gambar lama

use Illuminate\Support\Facades\Storage;


class NonkadController extends Controller
{
    //
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all nonkads
        $nonakademiks = NonAkademik::latest()->paginate(10);

        //render view with products
        return view('nonakademiks.index', compact('nonakademiks'));
    }

    public function create(): View
    {
        return view('nonakademiks.createsinkad');
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
            'kegiatan'         => 'required|min:5',
            'kategori'         => 'required|min:2',
            'ta'               => 'required|min:4',
            'brosur'           => 'required|image|mimes:jpeg,jpg,png|max:2048',
            // 'semester'         => 'required|min:4',
            'biaya'         => 'required|numeric'
        ]);

        //upload image
        $brosur = $request->file('brosur');
        // $brosur->storeAs('/storage/app/public/image', $brosur->hashName());
        $brosur->storeAs('public/brosurs', $brosur->hashName());

        //create product
        Nonakademik::create([
            'kegiatan'  => $request->kegiatan,
            'kategori'  => $request->kategori,
            'ta'        => $request->ta,
            'brosur'    => $brosur->hashName(),
            // 'semester'  => $request->semester,
            'biaya'     => $request->biaya
        ]);

        //redirect to index
        return redirect()->route('nonakademiks.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
     /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get product by ID
        $nonakademik = NonAkademik::findOrFail($id);

        //render view with product
        return view('nonakademiks.showsinkad', compact('nonakademik'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get product by ID
        $nonakademik = NonAkademik::findOrFail($id);

        //render view with product
        return view('nonakademiks.editsinkad', compact('nonakademik'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'kegiatan'         => 'required|min:5',
            'kategori'         => 'required|min:2',
            'ta'               => 'required|min:4',
            // 'brosur'           => 'required|image|mimes:jpeg,jpg,png|max:2048',
            // 'semester'         => 'required|min:4',
            'biaya'         => 'required|numeric'
        ]);

        //get product by ID
        $nonakademik = NonAkademik::findOrFail($id);

         //check if image is uploaded
         if ($request->hasFile('brosur')) {

            //upload new image
            $brosur = $request->file('brosur');
            $brosur->storeAs('public/brosurs', $brosur->hashName());

            //delete old image
            Storage::delete('public/brosurs/'.$nonakademik->brosur);

            //update product with new image
            $nonakademik->update([
                
                'kegiatan'  => $request->kegiatan,
                'kategori'  => $request->kategori,
                'ta'        => $request->ta,
                'brosur'    => $brosur->hashName(),
                'biaya'     => $request->biaya
            ]);

        } else {

            //update product without image
            //update nonakademik
            $nonakademik->update([
                'kegiatan'  => $request->kegiatan,
                'kategori'  => $request->kategori,
                'ta'        => $request->ta,
                // 'brosur'  => $request->brosur,
                'biaya'     => $request->biaya
            ]);
        }
          

        //redirect to index
        return redirect()->route('nonakademiks.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get product by ID
        $nonakademik = NonAkademik::findOrFail($id);

        if ($nonakademik->statusopen =="0")
        {
             //delete image
             Storage::delete('public/brosurs/'. $nonakademik->brosur);

            //delete product
            //jika statusopen masih 
            // status 0 = baru, 1 = regristrasi, 2 = selesai
                $nonakademik->delete();
              //redirect to index
            return redirect()->route('nonakademiks.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            // beri pesan kegiatan dg status open atau selesai tdk bisa dihapus
            return redirect()->route('nonakademiks.index')->with(['error' => 'Data tdk bisa Dihapus!']);
        }

      
    }
    
}
