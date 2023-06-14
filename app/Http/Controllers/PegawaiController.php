<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Divisi;
use App\Models\Jabatan;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Exports\PegawaiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PegawaiImport;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengarahkan ke view
        $pegawai = Pegawai::join('divisi', 'pegawai.divisi_id', '=', 'divisi_id')
            -> join('jabatan', 'pegawai.jabatan_id', '=', 'jabatan_id')
            -> select('pegawai.*', 'divisi.nama as divisi', 'jabatan.nama as jabatan')
            -> get();
        return view('admin.pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Arahkan ke folder pegawai
        $divisi = DB::table('divisi')->get();
        $jabatan = DB::table('jabatan')->get();
        $pegawai = Pegawai::join('divisi', 'pegawai.divisi_id', '=', 'divisi_id')
        -> join('jabatan', 'pegawai.jabatan_id', '=',    'jabatan_id')
        -> select('pegawai.*', 'divisi.nama as divisi', 'jabatan.nama as jabatan')
        -> get();
        return view('admin.pegawai.create', compact('pegawai', 'divisi', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Sintaks untuk menambahkan foto
        $request -> validate([
            'nip' => 'required|unique:pegawai|max:5',
            'nama' => 'required|max:45',
            'jabatan_id' => 'required|integer',
            'divisi_id' => 'required|integer',
            'gender' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'kekayaan' => 'required',
            'alamat' => 'nullable|string|min:10',
            'foto' => 'nullable|image|mimes:jpg,jpeg,gif,svg|max:2048',
        ],

        [
            'nip.required' => 'NIP Wajib Diisi',
            'nip.unique' => 'NIP Sudah Ada',
            'nip.max' => 'NIP Maksimal 5 Karakter',
            'nama.required' => 'Nama Wajib Diisi',
            'nama.max' => 'Nama wajib Diisi 45 Karakter',
            'jabatan_id.required' => 'Jabatan Wajib Diisi',
            'divisi_id.required' => 'Divisi Wajib Diisi',
            'gender.required' => 'Gender Wajib Diisi',
            'tmp_lahir.required' => 'Tempat Lahir Wajib Diisi',
            'tgl_lahir.required' => 'Tanggal Lahir Wajib Diisi', 
            'kekayaan.required' => 'Kekayaan Wajib Diisi',
        ]
    );

        if(!empty($request -> foto)){
            $fileName= 'foto-'.$request -> id.'.'.$request -> foto -> extension();
            $request -> foto -> move(public_path('admin/image'), $fileName);
        }
        else{
            $fileName = '';
        }

        // Fungsi menambahkan pegawai
        DB::table('pegawai')->insert([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'divisi_id' => $request->divisi_id,
            'gender' => $request->gender,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'kekayaan' => $request->kekayaan,
            'alamat' => $request->alamat,
            'foto' => $fileName,
        ]);
        return redirect('admin/pegawai');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $pegawai = Pegawai::join('divisi', 'pegawai.divisi_id', '=', 'divisi.id')
        -> join('jabatan', 'pegawai.jabatan_id', '=', 'jabatan.id')
        -> select('pegawai.*', 'divisi.nama as divisi', 'jabatan.nama as jabatan')
        -> where('pegawai.id, $id')
        -> get();
        return view('admin.pegawai.detail', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $divisi = DB::table('divisi') -> get();
        $jabatan = DB::table('jabatan') -> get();
        $pegawai = DB::table('pegawai') -> where('id', $id) -> get();
        $ar_gender = ['L', 'P'];
        return view ('admin.pegawai.edit', compact('divisi','jabatan','pegawai', 'ar_gender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $request -> validate([
            'nama' => 'required|max:45',
            'jabatan_id' => 'required|integer',
            'divisi_id' => 'required|integer',
            'gender' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'kekayaan' => 'required',
            'alamat' => 'nullable|string|min:10',
            'foto' => 'nullable|image|mimes:jpg,jpeg,gif,svg|max:2048',
        ]);

        // Foto lama apabila user menganti fotonya
        $foto = DB::table('pegawai') -> select('foto') -> where('id', $request -> id) -> get();
        foreach($foto as $f){
            $namaFileFotoLama = $f -> foto;
        }
        // Apakah user ingin menganti foto?
        if(!empty($request -> foto)){
        // Jika ada Foto Lama hapus dahulu
        if(!empty($p -> foto)) unlink('admin/image/'.$p -> foto);
        // Proses Menganti Foto
            $fileName = 'foto-'.$request->id.'.'.$request->foto->extension();
            $request->foto->move(public_path('admin/image'), $fileName);
        }
        else {
            $fileName = $namaFileFotoLama;
        }

        DB::table('pegawai') -> where('id', $request -> id) -> update([
            'nip' => $request -> nip,
            'nama' => $request -> nama,
            'jabatan_id' => $request -> jabatan_id,
            'divisi_id' => $request -> divisi_id,
            'gender' => $request -> gender,
            'tmp_lahir' => $request -> tmp_lahir,
            'tgl_lahir' => $request -> tgl_lahir,
            'kekayaan' => $request->kekayaan,
            'alamat' => $request -> alamat,
            'foto' => $fileName,
        ]);
        return redirect('admin/pegawai');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menambahkan tombol hapus pada pegawai
        DB::table('pegawai') -> where('id', $id) -> delete();
        return redirect('admin/pegawai');
    }

    public function generatePDF(){
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('admin.pegawai.myPDF', $data);
    
        return $pdf->download('testdownload.pdf');
    }

    public function pegawaiPDF(){
        $pegawai = Pegawai::all();
        $pdf = PDF::loadView('admin.pegawai.pegawaiPDF', ['pegawai' => $pegawai]) -> setPaper('a4', 'landscape');
        //return $pdf -> download('data_pegawai.pdf');
        return $pdf -> stream();
    }

    public function exportexcel(){
        return Excel::download(new PegawaiExport, 'pegawai.xlsx');
    }

    public function importExcel(Request $request){
        $file = $request -> file('file');
        $nama_file = rand().$file -> getClientOriginalName();
        $file -> move('file_excel', $nama_file);
        Excel::import(new PegawaiImport, public_path('/file_excel/'.$nama_file));
        return redirect('admin/pegawai');
    }
}
