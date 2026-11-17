<?php

namespace App\Models;

use App\Models\Peminjaman as PeminjamanModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggotas';

    protected $fillable = [
        'user_id',
        'nama',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function peminjamans()
    {
        return $this->hasMany(PeminjamanModel::class, 'anggota_id');
    }
}
