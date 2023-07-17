<?php

namespace App\Http\Controllers;

use App\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $Pembayaran = Pembayaran::latest()->paginate(5);
        return view('Pembayaran.list', compact('Pembayaran'));
    }
}
