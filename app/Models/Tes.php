<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tes extends Model
{
    use HasFactory;

    protected $table = 'tes';

    protected $fillable = [
        'nama',
        'id_personil',
        'hasil_kesehatan',
        'hasil_psikologi',
        'hasil_menembak',
    ];

    public function personil()
    {
        return $this->belongsTo(Personil::class, 'id_personil');
    }
}
