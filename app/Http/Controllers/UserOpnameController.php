<?php

namespace App\Http\Controllers;

use App\Models\Opname;
use Illuminate\Http\Request;

class UserOpnameController extends Controller
{
    public function index()
    {
        $opnames = Opname::with('pengadaan.masterBarang')->get(); // Ambil semua data opname
        return view('user.opname.index', compact('opnames'));
    }

    public function show(Opname $opname)
    {
        return view('user.opname.show', compact('opname'));
    }
}
