<form action="{{ route('jadwal.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="konselor_id">Konselor</label>
        <select name="konselor_id" id="konselor_id" required>
            @foreach($konselors as $konselor)
                <option value="{{ $konselor->id }}">{{ $konselor->name }}</option>
            @endforeach
        </select>

        </select>
    </div>

    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="jam">Waktu</label>
        <input type="time" name="jam" id="jam" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control" required>
            <option value="tersedia">Tersedia</option>
            <option value="dipesan">Dipesan</option>
        </select>
    </div>

    <button style="background-color: #007bff; color: white;">Tambah Jadwal</button>
</form>
