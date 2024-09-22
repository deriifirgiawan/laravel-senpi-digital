<?php

namespace App\Http\Controllers\approver;

use App\Http\Controllers\Controller;
use App\Models\KartuPengajuan;
use App\Models\Personil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersetujuanController extends Controller
{
    public function Index(Request $request)
    {
        $listKartu = KartuPengajuan::with(['personil', 'senjata', 'tes'])->where('status', 'Pending')->get();
        return view('approver.persetujuan.index', compact('listKartu'));
    }
    public function detail($id)
    {
        $kartu = KartuPengajuan::with(['personil', 'senjata'])->find($id);
        return response()->json($kartu);
    }
    public function setuju(Request $request, $id)
    {
        $kartu = KartuPengajuan::findOrFail($id);
        $user = Auth::user();
        $personil = Personil::find($user->personil_id);
        $kodeKartu = time();
        $status = "Diterima";
        $berlakuSampaiDengan = now()->addYears(5);
        $kartuData = [
            'kode_kartu' => "$kodeKartu",
            'status' => $status,
            'berlaku_sampai_dengan' => $berlakuSampaiDengan,
            'tanggal_update' => now(),
            'update_by' => $personil->nama,
        ];
        try {
            $kartu->update($kartuData);
            return redirect()->route('approver-persetujuan.index')->with('success', 'Data berhasil diupdate.');
        } catch (\Throwable $th) {
            return redirect()->route('approver-persetujuan.index')->with('error', 'Data gagal diupdate.');
        }
    }

    public function reject(Request $request)
    {
        $request->validate([
            'reject_id'=>'required',
            'rejectMessage'=>'required',
        ]);

        $kartuId = $request->input('reject_id');
        $msg = $request->input('rejectMessage');
        $user = Auth::user();
        $kartu = KartuPengajuan::findOrFail($kartuId);

        $kartuData = [
            'status' => 'Ditolak',
            'status_description' => $msg,
            'tanggal_update' => now(),
            'update_by' => $user->id,
        ];

        try {
            $kartu->update($kartuData);
            return redirect()->route('approver-persetujuan.index')->with('success', 'Data berhasil diupdate.');
        } catch (\Throwable $th) {
            return redirect()->route('approver-persetujuan.index')->with('error', 'Data gagal diupdate.');
        }
    }
}
