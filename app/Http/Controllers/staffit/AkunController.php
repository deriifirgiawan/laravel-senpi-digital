<?php

namespace App\Http\Controllers\staffit;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\Personil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function Index(Request $request)
    {
        $akun = Akun::with('personil')->get();
        $personilWithoutAkun = Personil::whereDoesntHave('akun')->get();
        return view('staffit.account.index', compact('akun', 'personilWithoutAkun'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'username' => 'required|unique:akun',
            'email' => 'required|unique:akun|email',
            'password' => 'required|min:6',
            'role' => 'required',
            'personil_id' => 'required'
        ]);
        // Memulai transaksi
        try {
            DB::transaction(function () use ($request) {
                $akunData = [
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'email' => $request->email,
                    'role' => $request->role,
                    'personil_id' => $request->personil_id,
                ];


                // Buat objek Akun baru
                Akun::create($akunData);
            });
            return redirect()->route('staff-it-akun.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Throwable $th) {
            return redirect()->route('staff-it-akun.index')->with('error', 'Data gagal disimpan.');
        }
    }
    public function edit($id)
    {
        $akun = Akun::with('personil')->find($id);
        return response()->json($akun);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
        ]);

        // Memulai transaksi
        try {
            DB::transaction(function () use ($request, $id) {
                // Update data Akun
                $akun = Akun::findOrFail($id);
                $akunData = [
                    'username' => $request->username,
                    'email' => $request->email,
                ];
                $akun->update($akunData);
                // Update data akun diperbarui
            });
            return redirect()->route('staff-it-akun.index')->with('success', 'Data berhasil diupdate.');
        } catch (\Throwable $th) {
            return redirect()->route('staff-it-akun.index')->with('error', 'Data gagal diupdate.');
        }
    }
    public function destroy($id)
    {
        // Cari data Akun berdasarkan ID
        $akun = Akun::find($id);

        if (!$akun) {
            return redirect()->route('staff-it-akun.index')->with('error', 'Data tidak ditemukan.');
        }

        $akun->delete();

        return redirect()->route('staff-it-akun.index')->with('success', 'Data berhasil dihapus.');
    }
}
