<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Http\Resources\MahasiswaResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::latest()->paginate(5);
        return new MahasiswaResource(true, 'List Data Mahasiswa', $mahasiswa);
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
        $validator = Validator::make($request->all(),[
           
            'nama' => 'required',
            'nim' => 'required',
            'alamat' => 'required',
            'prodi' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 442);
        }

        

        $mahasiswa = Mahasiswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'alamat' => $request->alamat,
            'prodi' => $request->prodi,
        ]);

        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Ditambahkan!', $mahasiswa);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return new MahasiswaResource(true, 'Data mahasiswa ditemukan!', $mahasiswa);
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
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validator = Validator::make($request->all(),[
           
            'nama' => 'required',
            'nim' => 'required',
            'alamat' => 'required',
            'prodi' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 442);
        }

        

        $mahasiswa->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'alamat' => $request->alamat,
            'prodi' => $request->prodi,
        ]);

        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Diubah!', $mahasiswa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        Storage::delete('public/mahasiswa/' .$mahasiswa->image);
        $mahasiswa->delete();
        return new MahasiswaResource(true, 'Data mahasiswa berhasil dihapus', null);
    }
}