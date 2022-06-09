<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Produk;
use PDF;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');
        // dd($data);
        $idManager = auth()->user()->id;
        $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', 'produk.id_kategori')
            ->select('produk.*', 'nama_kategori')->get()->where('idManager',$idManager);
        return view('produk.index', compact('produk','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idprofil = auth()->user()->id;
        $produk = Produk::latest()->first() ?? new Produk();
        $request['kode_produk'] = 'P'. tambah_nol_didepan((int)$produk->id_produk +1, 6);
        $idprofil = auth()->user()->id;
        $input = $request->all();
        
        if ($image = $request->file('path_img')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['path_img'] = "$profileImage";
        }
        // dd($input);
        $input['idManager']=$idprofil;
        Produk::create($input);
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');
        // dd($data);
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::find($id);

        return response()->json($produk);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $produk->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $Produk)
    {
        $Produk->delete();
     
        return redirect()->route('produk.index')
                        ->with('success','Product deleted successfully');
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_produk as $id) {
            $produk = Produk::find($id);
            $produk->delete();
        }

        return response(null, 204);
    }

    // public function cetakBarcode(Request $request)
    // {
    //     $dataproduk = array();
    //     foreach ($request->id_produk as $id) {
    //         $produk = Produk::find($id);
    //         $dataproduk[] = $produk;
    //     }

    //     $no  = 1;
    //     $pdf = PDF::loadView('produk.barcode', compact('dataproduk', 'no'));
    //     $pdf->setPaper('a4', 'potrait');
    //     return $pdf->stream('produk.pdf');
    // }
}
