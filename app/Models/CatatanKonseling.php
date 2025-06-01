<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatatanKonseling extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_pasien',
        'judul',
        'isi',
        'penyakit',
        'nama_dokter',
        'tanggal_konseling',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
