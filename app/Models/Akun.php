<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Akun extends Authenticatable
{
    use Notifiable;

    protected $table = 'akun';
    protected $primaryKey = 'id_akun';

    protected $fillable = [
        'username', 'email', 'password', 'personil_id', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function personil()
    {
        return $this->belongsTo(Personil::class, 'personil_id', 'id_personil');
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }
}
