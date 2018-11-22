<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JenisPerkara;
class JenisPerkaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_perkara = JenisPerkara::latest()->get();
        return view('jenis_perkara.index', compact('jenis_perkara'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis_perkara.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'nama' => 'required|unique:jenis_perkara,nama'
        ]);

        $jenis = JenisPerkara::create([
            'nama' => $request->get('nama'),
        ]);

        return redirect(route('jenis_perkara.index'))->with(['success' => true, 'msg' => 'Berhasil']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis = JenisPerkara::findOrFail($id);
        return view('jenis_perkara.edit', compact('jenis'));
        
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
        $this->validate($request, [

            'nama' => 'required|unique:jenis_perkara,nama,'. $id,
        ]);


        $jenis = JenisPerkara::findOrFail($id);
        $jenis->nama = $request->get('nama');
        $jenis->save();

        return redirect(route('jenis_perkara.index'))->with(['success' => true, 'msg' => 'Berhasil']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis = JenisPerkara::findOrFail($id);
        $jenis->delete();

       
        return response()->json(['success' => true, 'msg' => 'Berhasil']);

    }
}
