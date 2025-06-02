<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalKonseling;
use App\Models\User;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // JadwalController.php
public function index()
{
    // Fetch data from the database, including konselor relation
    $jadwalKonseling = JadwalKonseling::with('konselor')->get(); // eager load 'konselor'

    // Pass it to the view
    return view('konselor.jadwal.index', compact('jadwalKonseling'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Fetch the konselors (users with 'konselor' role)
    $konselors = User::where('role', 'konselor')->get();  // Adjust based on your User model structure and role

    // Return the view and pass the $konselors variable
    return view('konselor.jadwal.create', compact('konselors'));
}


    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    // Validate incoming data
    $validated = $request->validate([
        'konselor_id' => 'required|exists:users,id', // Ensure konselor_id exists in the users table
        'tanggal' => 'required|date',
        'jam' => 'required|date_format:H:i', // Ensure the time format is valid
        'status' => 'required|in:tersedia,dipesan',
    ]);

    if (!User::find($validated['konselor_id'])) {
        return back()->withErrors(['konselor_id' => 'Konselor ID not found']);
    }

    // Create a new jadwal konseling record
    JadwalKonseling::create([
        'konselor_id' => $validated['konselor_id'],
        'tanggal' => $validated['tanggal'],
        'jam' => $validated['jam'],
        'status' => $validated['status'],
    ]);

    return redirect()->route('jadwal.index')->with('success', 'Jadwal konseling berhasil ditambahkan!');
}





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $jadwal = JadwalKonseling::findOrFail($id);  // Fetch the jadwal data
    $konselors = User::where('role', 'konselor')->get();  // Fetch the konselors with 'konselor' role

    return view('konselor.jadwal.edit', compact('jadwal', 'konselors'));  // Pass both to the view
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validate incoming data
    $validated = $request->validate([
        'konselor_id' => 'required|exists:users,id', // Ensure konselor_id exists in the users table
        'tanggal' => 'required|date', // Ensure the date is in the correct format
        'jam' => 'required|date_format:H:i', // Ensure the time format is valid
        'status' => 'required|in:tersedia,dipesan', // Ensure status is either 'tersedia' or 'dipesan'
    ]);

    // Find the jadwal record by ID
    $jadwal = JadwalKonseling::findOrFail($id);

    // Update the record
    $jadwal->update([
        'konselor_id' => $validated['konselor_id'],
        'tanggal' => $validated['tanggal'],
        'jam' => $validated['jam'],
        'status' => $validated['status'],
    ]);

    // Redirect with success message
    return redirect()->route('jadwal.index')->with('success', 'Jadwal konseling berhasil diperbarui');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = JadwalKonseling::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal konseling berhasil dihapus');
    }
}
