<?php

namespace App\Http\Controllers;

use App\BerkasPerkara;
use App\JenisPerkara;
use App\Perkara;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
class PerkaraController extends Controller
{   

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perkaras = Perkara::get();
        return view('perkara.index', compact('perkaras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = JenisPerkara::get();

        return view('perkara.create', compact('jenis'));
        
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
            'no_perkara' => 'required|unique:perkara,no_perkara',
            'jenis_perkara_id' => 'required',

        ]);

        $perkara = Perkara::create([
            'no_perkara' => $request->get('no_perkara'),
            'jenis_perkara_id' => $request->get('jenis_perkara_id'),
        ]);

        if ($perkara) {
            foreach ($request->file('berkas') as $key => $berkas) {
                $pathPhotoBaru = $berkas->store('berkas-perkara');
                $fileName = File::basename($pathPhotoBaru);

                $berkasPerkara = BerkasPerkara::create([
                    'perkara_id' => $perkara->id,
                    'nama' => $request->get('nama')[$key],
                    'file' => $fileName,

                ]);
                

            }
        }

        return redirect(route('perkara.index'))->with(['success' => true, 'msg' => 'Berhasil']);




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
        $perkara = Perkara::findOrFail($id);
        $jenis = JenisPerkara::get();
        $berkas = $perkara->berkas_perkara;
        
        return view('perkara.edit', compact('perkara', 'jenis', 'berkas'));
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

        $perkara = Perkara::findOrFail($id);
        $berkasOri = $perkara->berkas_perkara;
        $IDberkasOri = $berkasOri->pluck('id')->toArray();

       // Ubah data model perkara
        $perkara->no_perkara = $request->get('no_perkara');
        $perkara->jenis_perkara_id = $request->get('jenis_perkara_id');
        $perkara->save();


       //hapus berkas yang tidak ada di database
        $IDberkasInput = $request->get('berkas_id') ?? [];
        $IDnotExist = array_diff($IDberkasOri, $IDberkasInput);
        foreach ($IDnotExist as $key => $idBerkas) {
            $berkasDel = $berkasOri->where('id', $idBerkas)->first();

            $pathDir = 'berkas-perkara/';
            $fullPath = $pathDir . $berkasDel->file;
            Storage::delete($fullPath);

            $berkasDel->delete();
        }
        $perkara = $perkara->fresh();


       // crawl seluruh inputan
        $daftarNama = $request->get('nama');

        foreach ($IDberkasInput as $key => $berkasID) {
            $nama = $daftarNama[$key];
            if ($berkasID == '-') {
                $berkas = $request->file('berkas')[$key];
                $pathBerkasBaru = $berkas->store('berkas-perkara');
                $fileName = File::basename($pathBerkasBaru);

                $berkasPerkara = BerkasPerkara::create([
                    'perkara_id' => $perkara->id,
                    'nama' => $nama,
                    'file' => $fileName,

                ]);

            } else {
                $berkasPerkara = $perkara->berkas_perkara->where('id', $berkasID)->first();
                $berkasPerkara->nama = $nama;

                if (isset($request->file('berkas')[$key])) {
                    $pathDir = 'berkas-perkara/';
                    $fullPath = $pathDir . $berkasPerkara->file;
                    Storage::delete($fullPath);

                    $berkas = $request->file('berkas')[$key];
                    $pathBerkasBaru = $berkas->store('berkas-perkara');
                    $fileName = File::basename($pathBerkasBaru);

                    $berkasPerkara->file = $fileName;
                }

                $berkasPerkara->save();
                
            }
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perkara = Perkara::findOrFail($id);

        $perkara->berkas_perkara->each(function($i) {

            $fileBerkas = $i->file;
            $pathDir = 'berkas-perkara/';
            $fullPath = $pathDir . $fileBerkas;
            Storage::delete($fullPath);
            $i->delete();

        });
        $perkara->delete();
    }
}
