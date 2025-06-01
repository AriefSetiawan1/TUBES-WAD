@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pemesanan Konseling</h1>
        
        <form action="{{ route('pemesanan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="schedule_id" value="{{ $schedule_id }}">

            <div class="form-group">
                <label for="status">Status Pemesanan</label>
                <select name="status" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Pesan Konseling</button>
        </form>
    </div>
@endsection
