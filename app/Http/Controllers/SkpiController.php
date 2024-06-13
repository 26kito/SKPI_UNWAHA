<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkpiController extends Controller
{
    public function view()
    {
        $data = DB::table('kategori_portofolio')->get();

        return view('input-skpi')->with('data', $data);
    }
}
