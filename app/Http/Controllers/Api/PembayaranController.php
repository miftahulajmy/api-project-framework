<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pembayaran;
use App\Http\Resources\PembayaranResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran = Pembayaran::latest()->paginate(5);
        return new PembayaranResource(true, 'List Data Pembayaran', $pembayaran);
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

            'NISN' => 'required', 
            'Tanggal' => 'required',
            'Jenis_pembayaran' => 'required',
            'Jumlah' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 442);
        }

        $pembayaran = pembayaran::create([
            'NISN' => $request->NISN,
            'Tanggal' => $request->Tanggal,
            'Jenis_pembayaran' => $request->Jenis_pembayaran,
            'Jumlah' => $request->Jumlah,
            
        ]);

        return new PembayaranResource(true, 'Data pembayaran Berhasil Ditambahkan!', $pembayaran);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(pembayaran $pembayaran)
    {
        return new PembayaranResource(true, 'Data pembayaran Berhasil Ditemukan!', $pembayaran);
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
    public function update(Request $request, pembayaran $pembayaran)
    {
        $validator = Validator::make($request->all(), [
            'NISN' => 'required',
            'Tanggal' => 'required',
            'Jenis_pembayaran' => 'required',
            'Jumlah' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 442);
        }
            $pembayaran->update([
                'NISN' => $request->NISN,
                'Tanggal' => $request->Tanggal,
                'Jenis_pembayaran' => $request->Jenis_pembayaran,
                'Jumlah' => $request->Jumlah,
            ]);
        return new PembayaranResource(true, 'Data pembayaran Berhasil Diubah!', $pembayaran);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return new PembayaranResource(true, 'Data pembayaran berhasil dihapus', null);
    }
}