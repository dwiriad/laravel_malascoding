<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai;
 
class PegawaiController extends Controller
{
    public function index(){
        // mengambil data dari table pegawai
		$pegawai = Pegawai::all();
 
        // mengirim data pegawai ke view index
        return view('pegawai',['pegawai' => $pegawai]);
    }

    public function formulir(){
 
    	return view('formulir');
 
    }

    public function proses(Request $request){
        $nama = $request->input('nama');
     	$alamat = $request->input('alamat');
        return "Nama : ".$nama.", Alamat : ".$alamat;
    }

    // method untuk menampilkan view form tambah pegawai
    public function tambah(){
        return view('pegawai_tambah');   
    }

    // method untuk insert data ke table pegawai
    public function store(Request $request)
    {
        $this->validate($request,[
    		'nama' => 'required',
    		'alamat' => 'required'
    	]);
 
        Pegawai::create([
    		'nama' => $request->nama,
    		'alamat' => $request->alamat
    	]);
 
    	return redirect('/pegawai');
    
    }

    // method untuk edit data pegawai
    public function edit($id)
    {
        // mengambil data pegawai berdasarkan id yang dipilih
        $pegawai = Pegawai::find($id);
        // passing data pegawai yang didapat ke view edit.blade.php
        return view('pegawai_edit',['pegawai' => $pegawai]);
    
    }

    // update data pegawai
    public function update($id, Request $request)
    {
        $this->validate($request,[
            'nama' => 'required',
            'alamat' => 'required'
        ]);
      
        $pegawai = Pegawai::find($id);
        $pegawai->nama = $request->nama;
        $pegawai->alamat = $request->alamat;
        $pegawai->save();
        // alihkan halaman ke halaman pegawai
        return redirect('/pegawai');
    }

    // method untuk hapus data pegawai
    public function delete($id)
    {
        // menghapus data pegawai berdasarkan id yang dipilih
        $pegawai = Pegawai::find($id);
        $pegawai->delete();
            
        // alihkan halaman ke halaman pegawai
        return redirect('/pegawai');
    }

    public function cari(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->cari;
 
    		// mengambil data dari table pegawai sesuai pencarian data
		$pegawai = DB::table('pegawai')
		->where('pegawai_nama','like',"%".$cari."%")
		->paginate();
 
    		// mengirim data pegawai ke view index
		return view('index',['pegawai' => $pegawai]);
 
	}
}