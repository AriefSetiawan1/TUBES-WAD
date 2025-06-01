@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Pemesanan Konseling</h1>
        <p><strong>Jadwal Konseling:</strong> {{ $pemesanan->schedule->date }} - {{ $pemesanan->schedule->time }}</p>
        <p><strong>Status:</strong> {{ $pemesanan->status }}</p>
        <p><strong>Nama Mahasiswa:</strong> {{ $pemesanan->user->name }}</p>
    </div>
@endsection
