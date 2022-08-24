<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(){
        $nama = "Dwi Ria Wulandari";
        $pelajaran = ["Basis Data", "Framework", "Statistika"];
    	return view('biodata',['nama' => $nama , 'matkul' => $pelajaran]);
    }
}
