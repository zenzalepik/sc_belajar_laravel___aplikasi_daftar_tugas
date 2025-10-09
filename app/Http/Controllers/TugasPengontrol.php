<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasPengontrol extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $semuaTugas = Tugas::all();
        return view('tugas.index', compact('semuaTugas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tugas.form', ['tugas' => new Tugas()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $data = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'nullable',
        ]);

        Tugas::create($data);
        return redirect()->route('tugas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    public function edit(Tugas $tugas) {
        //
        return view('tugas.form', compact('tugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    public function update(Request $request, Tugas $tugas) {
        //
        $data = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'nullable',
            'selesai' => 'boolean',
        ]);

        $tugas->update($data);
        return redirect()->route('tugas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    public function destroy(Tugas $tugas) {
        //
        $tugas->delete();
        return redirect()->route('tugas.index');
    }
}
