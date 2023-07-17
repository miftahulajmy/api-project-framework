<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\spp;
class sppController extends Controller
{
    public function index()
    {
        $spp = Spp::latest()->paginate(5);
        return view('spp.list', compact('spp'));
    }
}
