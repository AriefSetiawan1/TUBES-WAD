<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Storage;




class ArtikelController extends Controller
{
    // Menampilkan daftar artikel
    public function index()
    {
        $artikels = Artikel::all();
        return view('konselor.artikel.index', compact('artikels'));// Tampilkan ke view
    }

    // Menampilkan form untuk menambah artikel
    public function create()
    {
        return view('.konselor.artikel.create');
    }

    // Menyimpan artikel baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'author'            => 'required|string|max:255',
            'content'           => 'required|string',
            'publication_year'  => 'required|integer|min:1900|max:' . date('Y'),
            'image'             => 'nullable|image|max:2048',
        ]);

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            // Simpan file di folder 'artikels' pada disk 'public'
            $path = $request->file('image')->store('artikels', 'public');
            $validatedData['image'] = $path;
        }

        // Buat data artikel baru
        Artikel::create($validatedData);

        return redirect()->route('artikel.index')
                         ->with('success', 'Artikel berhasil ditambahkan.');
    }
    

    // Menampilkan form untuk mengedit artikel
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('konselor.artikel.edit', compact('artikel'));
    }

    // Memperbarui artikel
    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'author'            => 'required|string|max:255',
            'content'           => 'required|string',
            'publication_year'  => 'required|integer|min:1900|max:' . date('Y'),
            'image'             => 'nullable|image|max:2048',
        ]);

        // Jika ada upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($artikel->image && Storage::disk('public')->exists($artikel->image)) {
                Storage::disk('public')->delete($artikel->image);
            }
            // Simpan gambar baru
            $path = $request->file('image')->store('artikels', 'public');
            $validatedData['image'] = $path;
        }

        $artikel->update($validatedData);

        return redirect()->route('artikel.index')
                         ->with('success', 'Artikel berhasil diperbarui.');
    }

    // Menghapus artikel
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($artikel->image && Storage::disk('public')->exists($artikel->image)) {
            Storage::disk('public')->delete($artikel->image);
        }

        $artikel->delete();

        return redirect()->route('konselor.artikel.index')
                         ->with('success', 'Artikel berhasil dihapus.');
    }
}
