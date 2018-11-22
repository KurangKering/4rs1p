<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BerkasPerkara;
use Illuminate\Support\Facades\Storage;
use App\RiwayatPembaca;
class BerkasPerkaraController extends Controller
{

   public function get_file($id)
   {
    $berkas = BerkasPerkara::findOrFail($id);
    $dirPath = 'berkas-perkara/';
    $fullPath = $dirPath. $berkas->file;
    $fullPath = Storage::url($fullPath);

    return response()->json(['url' => $fullPath]);
}

public function read(Request $request)
{
    if ($request->isMethod('get')) {
        echo '<script>window.close();</script>';
    } 

    $id = $request->get('id');
    $berkas = BerkasPerkara::findOrFail($id);
    $berkasID = $berkas->id;

    $user = \Auth::check() ? \Auth::user() : false;
    if ($user) {
        $riwayat = RiwayatPembaca::create([
            'nama_pembaca' => $user->name,
            'berkas_perkara_id' => $berkasID,
            'user_id' => $user->id,
            'tanggal' => now(),
        ]);
    }

    return view('berkas_perkara.read_berkas', compact('berkas', 'berkasID'));

}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berkases = BerkasPerkara::get();
        return view('berkas_perkara.index', compact('berkases'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
