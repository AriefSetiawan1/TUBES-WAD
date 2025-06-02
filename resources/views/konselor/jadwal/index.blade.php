@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Jadwal Konseling</h2>

    <a href="{{ route('jadwal.create') }}" class="btn btn-primary">Tambah Jadwal Konseling</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Nama Konselor</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($jadwalKonseling->isEmpty())
                 <p>No jadwal found.</p>
            @endif
            @foreach ($jadwalKonseling as $jadwal)
                <tr>
                    <td>{{ $jadwal->konselor->name }}</td> 
                    <td>{{ $jadwal->tanggal }}</td>
                    <td>{{ $jadwal->jam }}</td>
                    <td>{{ $jadwal->status }}</td>
                    <td>
                        <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
