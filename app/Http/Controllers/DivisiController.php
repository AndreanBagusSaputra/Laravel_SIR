<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Divisi;
use Illuminate\Support\Facades\DB;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Memakai query builder
        $divisi = DB::table('divisi') -> get();
        return view('admin.divisi.index', compact('divisi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Arahkan ke file create
        return view('admin.divisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Fungsi untuk mengisi data form
        DB::table('divisi') -> insert([
            'nama' => $request -> nama,
        ]);
        return redirect('admin/divisi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $divisi = DB::table('divisi') -> where('id', $id) -> get();

        return view ('admin.divisi.detail', compact('divisi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $divisi = DB::table('divisi') -> where('id', $id) -> get();
        return view('admin.divisi.edit', compact('divisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Buat proses edit form
        DB::table('divisi') -> where('id', $request -> id) -> update([
            'nama' => $request -> nama,
        ]);
        // Ketika selesai mengupdate maka arahkan ke halaman admin disi idex
        return redirect('admin/divisi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('divisi')->where('id', $id)->delete();
        return redirect('admin/divisi');
    }
}
