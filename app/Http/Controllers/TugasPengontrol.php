<?php
// D:\Github\sc_belajar_laravel___aplikasi_daftar_tugas\app\Http\Controllers\TugasPengontrol.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;

use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasPengontrol extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $query = $request->query('q'); // Ambil parameter search

        $tugasQuery = Tugas::query();

        // Filter status
        if ($filter === 'selesai') {
            $tugasQuery->where('selesai', true);
        } elseif ($filter === 'aktif') {
            $tugasQuery->where('selesai', false);
        }

        // Pencarian
        if ($query) {
            $tugasQuery->where(function ($q) use ($query) {
                $q->where('judul', 'like', "%{$query}%")
                ->orWhere('deskripsi', 'like', "%{$query}%");
            });
        }

        $semuaTugas = $tugasQuery->get();

        return view('tugas.index', compact('semuaTugas', 'filter'));
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
            'selesai' => 'boolean',
            'deadline' => 'nullable|date',
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
            
        $tugas = Tugas::find($id);

        if (! $tugas) {
            abort(404, 'Tugas tidak ditemukan');
        }

        return view('tugas.show', compact('tugas'));
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
            'deadline' => 'nullable|date',
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

    
    public function detailBySlug($slug)
    {
        $tugas = Tugas::where('slug', $slug)->first();

        if (! $tugas) {
            abort(404, 'Tugas tidak ditemukan');
        }

        return view('tugas.show', compact('tugas'));
    }

    public function export()
    {
        $tugas = \App\Models\Tugas::all();

        $csvHeader = ['ID', 'Judul', 'Deskripsi', 'Status', 'Deadline'];
        $csvRows = $tugas->map(function ($item) {
            return [
                $item->id,
                $item->judul,
                $item->deskripsi,
                $item->selesai ? 'Selesai' : 'Aktif',
                $item->deadline ?? 'Tidak ada',
            ];
        });

        $csvContent = implode(',', $csvHeader) . "\n";
        foreach ($csvRows as $row) {
            $csvContent .= implode(',', array_map(fn($v) => '"' . str_replace('"', '""', $v) . '"', $row)) . "\n";
        }

        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="tugas.csv"',
        ]);
    }

    // public function export()
    // {
    //     return response('Export berhasil', 200);
    // }

    public function tampilkanDaftarTugas(Request $request)
    {
        $filter = $request->query('filter');
        $query  = $request->query('q');

        $tugasQuery = Tugas::query();

        if ($filter === 'selesai') {
            $tugasQuery->where('selesai', true);
        } elseif ($filter === 'aktif') {
            $tugasQuery->where('selesai', false);
        }

        if ($query) {
            $tugasQuery->where(function ($q) use ($query) {
                $q->where('judul', 'like', "%{$query}%")
                ->orWhere('deskripsi', 'like', "%{$query}%");
            });
        }

        $semuaTugas = $tugasQuery->get();

        return view('tugas.index', compact('semuaTugas', 'filter'));
    }

    public function statistikTugas()
    {
        $jumlahTotal   = Tugas::count();
        $jumlahSelesai = Tugas::where('selesai', true)->count();
        $jumlahAktif   = Tugas::where('selesai', false)->count();

        return view('tugas.statistik', compact(
            'jumlahTotal',
            'jumlahSelesai',
            'jumlahAktif'
        ));
    }


public function ambilStatistikTugas()
{
    $total = Tugas::count();
    $selesai = Tugas::where('selesai', true)->count(); // Perbaiki ini
    $belumSelesai = Tugas::where('selesai', false)->count(); // Dan ini

    return [
        'total' => $total,
        'selesai' => $selesai,
        'belum_selesai' => $belumSelesai,
    ];
}


}
