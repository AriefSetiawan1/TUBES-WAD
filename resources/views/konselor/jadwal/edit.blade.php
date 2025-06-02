<form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="konselor_id">Nama Konselor</label>
        <select name="konselor_id" id="konselor_id" class="form-control" required>
            @foreach ($konselors as $konselor)
                <option value="{{ $konselor->id }}" {{ $jadwal->konselor_id == $konselor->id ? 'selected' : '' }}>
                    {{ $konselor->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $jadwal->tanggal }}" required>
    </div>

    <div class="form-group">
        <label for="jam">Waktu</label>
        <input type="time" name="jam" id="jam" class="form-control" value="{{ $jadwal->jam }}" required>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control" required>
            <option value="tersedia" {{ $jadwal->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="dipesan" {{ $jadwal->status == 'dipesan' ? 'selected' : '' }}>Dipesan</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Jadwal</button>
</form>
