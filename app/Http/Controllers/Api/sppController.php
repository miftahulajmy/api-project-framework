<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\spp;
use App\Http\Resources\sppResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class sppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spp = Spp::latest()->paginate(5);
        return new sppResource(true, 'List Data SPP', $spp);
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
           
            'nominal' => 'required',
            'tahun' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 442);
        }

        

        $spp = Spp::create([
            'nominal' => $request->nominal,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
        ]);

        return new sppResource(true, 'Data SPP Berhasil Ditambahkan!', $spp);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Spp $spp)
    {
        return new sppResource(true, 'Data SPP ditemukan!', $spp);
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
    public function update(Request $request, Spp $spp)
    {
        $validator = Validator::make($request->all(),[
           
            'nominal' => 'required',
            'tahun' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 442);
        }

        

        $spp->update([
            'nominal' => $request->nominal,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
        ]);

        return new sppResource(true, 'Data SPP Berhasil Diubah!', $spp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spp $spp)
    {
        Storage::delete('public/spp/' .$spp->image);
        $spp->delete();
        return new SppResource(true, 'Data SPP berhasil dihapus', null);
    }
}
