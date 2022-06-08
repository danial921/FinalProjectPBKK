<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idprofil = auth()->user()->id;
        $kategori = Kategori::orderBy('id_kategori', 'desc')->get()->where('idManager',$idprofil);

        return view('kategori.index', compact('kategori'));
    }

    public function data()
    {
        $idprofil = auth()->user()->id;
        $kategori = Kategori::orderBy('id_kategori', 'desc')->get()->where('idManager',$idprofil);

        return (datatables()
            ->of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('kategori.update', $kategori->id_kategori) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button onclick="deleteData(`'. route('kategori.destroy', $kategori->id_kategori) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true));
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

        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori['idManager'] = $idprofil;
        $kategori->save();
        $kategori = Kategori::orderBy('id_kategori', 'desc')->get()->where('idManager',$idprofil);

        return view('kategori.index', compact('kategori'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori = Kategori::find($id);

        return response()->json($kategori);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(kategori $kategori)
    {
        return view('kategori.edit',compact('kategori'));
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
        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->update();

        return response()->json('Data berhasil disimpan', 200);
    }

    //  public function update(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //     ]);
  
    //     $input = $request->all();
    //     $Kategori:update([
    //         'ketinggianMin' => $request->ketinggianMin,
    //         'ketinggianMax' => $request->ketinggianMax,
    //         'salinitasMin' => $request->salinitasMin,
    //         'salinitasMax' => $request->salinitasMax,
    //     ]);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $kategori = Kategori::find($id);
    //     $kategori->delete();

    //     return response(null, 204);
    // }
    public function destroy(Kategori $Kategori)
    {
        $Kategori->delete();
     
        return redirect()->route('kategori.index')
                        ->with('success','Product deleted successfully');
    }

}
