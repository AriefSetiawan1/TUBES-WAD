<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CatatanKonseling;

class CatatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua catatan milik user yang sedang login
        $catatan = auth()->user()->catatan()->latest('tanggal_konseling')->get();

        return view('konselor.catatan.index', compact('catatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('konselor.catatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pasien'       => 'required|string|max:255',
            'judul'             => 'required|string|max:255',
            'isi'               => 'required|string',
            'penyakit'          => 'required|string|max:255',
            'nama_dokter'       => 'required|string|max:255',
            'tanggal_konseling' => 'required|date',
        ]);

        // Tambahkan user_id ke data yang divalidasi
        $validatedData['user_id'] = auth()->id();

        CatatanKonseling::create($validatedData);

        return redirect()->route('konselor.catatan.index')
                         ->with('success', 'Catatan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $catatan = auth()->user()->catatan()->findOrFail($id);

        // Jika request adalah AJAX, return JSON
        if (request()->ajax()) {
            return response()->json($catatan);
        }

        // Jika bukan AJAX, return view
        return view('konselor.catatan.show', compact('catatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $catatan = auth()->user()->catatan()->findOrFail($id);

        return view('konselor.catatan.edit', compact('catatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_pasien'       => 'required|string|max:255',
            'judul'             => 'required|string|max:255',
            'isi'               => 'required|string',
            'penyakit'          => 'required|string|max:255',
            'nama_dokter'       => 'required|string|max:255',
            'tanggal_konseling' => 'required|date',
        ]);

        $catatan = auth()->user()->catatan()->findOrFail($id);
        $catatan->update($validatedData);

        return redirect()->route('konselor.catatan.index')
                         ->with('success', 'Catatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catatan = auth()->user()->catatan()->findOrFail($id);
        $catatan->delete();

        return redirect()->route('konselor.catatan.index')
                         ->with('success', 'Catatan berhasil dihapus.');
    }
}
