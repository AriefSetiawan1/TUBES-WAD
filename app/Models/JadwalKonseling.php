<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKonseling extends Model
{
    use HasFactory;

    protected $fillable = [
        'konselor_id', 'tanggal', 'jam', 'status'
    ];

    public function konselor()
{
    return $this->belongsTo(User::class, 'konselor_id'); // assuming 'konselor_id' is the foreign key
}

}

