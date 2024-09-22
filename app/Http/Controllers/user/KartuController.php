<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\KartuPengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KartuController extends Controller
{
    public function Index()
    {
        $user = Auth::user();
        $cards = KartuPengajuan::query()
            ->select(
                'kartu_pengajuan.id',
                'kartu_pengajuan.kode_kartu',
                'kartu_pengajuan.tanggal_update',
                'kartu_pengajuan.status',
                'personil.id_personil',
                'personil.nrp',
                'personil.nama',
                'personil.pangkat',
                'personil.jabatan',
                'personil.kesatuan',
                'personil.foto_pribadi',
                'weapon.jenis',
                'weapon.type',
                'weapon.nomor',
                'weapon.kaliber'
            )
            ->leftJoin('personil', 'kartu_pengajuan.id_personil', '=', 'personil.id_personil')
            ->leftJoin('weapon', 'kartu_pengajuan.id_senjata', '=', 'weapon.id')
            ->where('kartu_pengajuan.status', '=', 'Diterima')
            ->where('kartu_pengajuan.id_personil', '=', $user->personil_id)
            ->get();
        return view('user.kartu.index', compact('cards'));
    }

    public function detail($id)
    {
        $user = Auth::user();
        $card =  KartuPengajuan::query()
            ->select(
                'kartu_pengajuan.id',
                'kartu_pengajuan.kode_kartu',
                'kartu_pengajuan.tanggal_update',
                'kartu_pengajuan.status',
                'kartu_pengajuan.berlaku_sampai_dengan',
                'kartu_pengajuan.update_by',
                'personil.id_personil',
                'personil.nrp',
                'personil.nama',
                'personil.pangkat',
                'personil.jabatan',
                'personil.kesatuan',
                'personil.foto_pribadi',
                'weapon.jenis',
                'weapon.type',
                'weapon.nomor',
                'weapon.kaliber'
            )
            ->leftJoin('personil', 'kartu_pengajuan.id_personil', '=', 'personil.id_personil')
            ->leftJoin('weapon', 'kartu_pengajuan.id_senjata', '=', 'weapon.id')
            ->where('kartu_pengajuan.id_personil', '=', $user->personil_id)
            ->where('kartu_pengajuan.id', '=', $id)
            ->first();
        return view('user.kartu.detail', compact('card'));
    }
}
