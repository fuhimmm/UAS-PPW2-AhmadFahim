<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory, SoftDeletes;

    // Menentukan nama tabel agar tidak salah baca jadi 'pegawais'
    protected $table = 'pegawai';

    // PENTING: Baris ini mengizinkan semua data disimpan kecuali ID
    // Tanpa baris ini, akan muncul error MassAssignmentException (seperti yang kamu alami)
    protected $guarded = ['id'];

    // Relasi ke tabel Pekerjaan
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id');
    }
}
