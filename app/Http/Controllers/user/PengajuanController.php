<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\KartuPengajuan;
use App\Models\Tes;
use App\Models\Weapon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index()
    {
        $listPersetujuan = KartuPengajuan::all();

        return view('user.pengajuan.index', compact('listPersetujuan'));
    }

    public function formPengajuan()
    {
        $weapons = Weapon::all();
        $user = Auth::user();
        $test = Tes::where('id_personil', $user->personil_id)->get();

        return view('user.pengajuan.add', compact('weapons', 'test'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'weapon' => 'required',
            'test_id' => 'required',
        ]);

        $weapon = $request->input('weapon');
        $arrayData = json_decode($weapon, true);

        $user = Auth::user();

        $kodeKartu = time();

        $tanggalPengajuan = now();

        $status = "Pending";

        $berlakuSampaiDengan = now()->addMonth();

        $kartuPengajuan = new KartuPengajuan([
            'kode_kartu' => $kodeKartu,
            'tanggal_pengajuan' => $tanggalPengajuan,
            'id_personil' => $user->personil_id,
            'id_senjata' => $arrayData['id'],
            'status' => $status,
            'berlaku_sampai_dengan' => $berlakuSampaiDengan,
            'tanggal_update' => now(),
            'update_by' => $user->id,
            'tes_id' => $request->test_id
        ]);

        $kartuPengajuan->save();

        return redirect()->route('pengajuan')->with('success', 'Data has been saved successfully!');
    }
}
