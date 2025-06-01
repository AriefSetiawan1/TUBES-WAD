@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Jadwal Konseling Tersedia</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Jadwal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->date }} - {{ $schedule->time }}</td>
                        <td>
                            <a href="{{ route('pemesanan.create', $schedule->id) }}" class="btn btn-primary">Pilih Jadwal</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
