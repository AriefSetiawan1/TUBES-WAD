<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();  
        return view('pemesanan.index', compact('schedules'));
    }

    public function create($schedule_id)
    {
        return view('pemesanan.create', compact('schedule_id'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'schedule_id' => 'required|integer',
        ]);

        Pemesanan::create([
            'user_id' => $request->user_id,
            'schedule_id' => $request->schedule_id,
            'status' => 'pending', 
        ]);

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil!');
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::find($id);
        return view('pemesanan.show', compact('pemesanan'));
    }
}

