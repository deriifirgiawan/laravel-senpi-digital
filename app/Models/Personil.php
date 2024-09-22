<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personil extends Model
{
    use HasFactory;

    protected $table = 'personil';
    protected $primaryKey = 'id_personil';

    protected $fillable = [
        'nrp',
        'nama',
        'pangkat',
        'jabatan',
        'kesatuan',
        'foto_pribadi',
    ];
    public function akun()
    {
        return $this->hasOne(Akun::class, 'personil_id', 'id_personil');
    }

    public function tes()
    {
        return $this->hasMany(Tes::class, 'personil_id');
    }

    public function kartu_pengajuan()
    {
        return $this->hasMany(KartuPengajuan::class, 'id_personil');
    }
}
