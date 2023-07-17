<?php

namespace App\Http\Controllers\Api;
use App\categori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\categoriResource;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;

class categoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $categoris = categori::latest()->paginate(5);
         return new categoriResource(true, 'List Data categoris', $categoris);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nama'     => 'required',
            'Status'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $categori = categori::create([
            'Nama'     => $request->Nama,
            'Status'   => $request->Status,
        ]);

        return new categoriResource(true, 'Data categori Berhasil Ditambahkan!', $categori);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(categori $categori)
    {
        return new categoriResource(true, 'Data categori Ditemukan!', $categori);
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
    public function update(Request $request, categori $categori)
    {
                $validator = Validator::make($request->all(), [
                    'Nama'     => 'required',
                    'Status'   => 'required',
                ]);
        
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }
        
                if ($request->hasFile('image')) {
        
                    
        
                    $categori->update([
                        'Nama'     => $request->Nama,
                        'Status'   => $request->Status,
                    ]);
        
                } else {
        
                   
                    $categori->update([
                        'Nama'     => $request->Nama,
                        'Status'   => $request->Status,
                    ]);
                }
                return new categoriResource(true, 'Data categori Berhasil Diubah!', $categori);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(categori $categori)
    {
        $categori->delete();
        return new categoriResource(true, 'Data categori Berhasil Dihapus!', null);
    }
}