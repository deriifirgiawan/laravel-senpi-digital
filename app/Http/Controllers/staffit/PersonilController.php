<?php

namespace App\Http\Controllers\staffit;

use App\Http\Controllers\Controller;
use App\Models\Personil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonilController extends Controller
{
    public function Index(Request $request)
    {
        $personil =  Personil::all();
        return view('staffit.personil.index', compact('personil'));
    }

    public function destroy($id)
    {
        // Cari data Personil berdasarkan ID
        $personil = Personil::find($id);

        if (!$personil) {
            return redirect()->route('staff-it-personil.index')->with('error', 'Data tidak ditemukan.');
        }

        // Hapus data Personil dan Akun terkait
        $personil->akun()->delete();
        $personil->delete();

        return redirect()->route('staff-it-personil.index')->with('success', 'Data berhasil dihapus.');
    }
    public function store(Request $request)
    {

        $request->validate([
            'nrp' => 'required|unique:personil',
            'nama' => 'required',
            'pangkat' => 'required',
            'kesatuan' => 'required',
        ]);
        // Memulai transaksi
        try {
            DB::transaction(function () use ($request) {
                $personilData = [
                    'nrp' => $request->nrp,
                    'nama' => $request->nama,
                    'pangkat' => $request->pangkat,
                    'jabatan' => $request->jabatan,
                    'kesatuan' => $request->kesatuan,
                ];

                Personil::create($personilData);
            });
            return redirect()->route('staff-it-personil.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('staff-it-personil.index')->with('errors', ['Data berhasil disimpan.']);
        }
    }
    public function edit($id)
    {
        $personil = Personil::find($id);
        return response()->json($personil);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nrp' => 'required',
            'nama' => 'required',
            'pangkat' => 'required',
            'jabatan' => 'required',
            'kesatuan' => 'required',
        ]);

        // Memulai transaksi
        try {
            DB::transaction(function () use ($request, $id) {

                $personilData = [
                    'nrp' => $request->nrp,
                    'nama' => $request->nama,
                    'pangkat' => $request->pangkat,
                    'jabatan' => $request->jabatan,
                    'kesatuan' => $request->kesatuan,
                ];

                $personil = Personil::findOrFail($id);
                $personil->update($personilData);
            });
            return redirect()->route('staff-it-personil.index')->with('success', 'Data berhasil diupdate.');
        } catch (\Throwable $th) {
            return redirect()->route('staff-it-personil.index')->with('errors', ['Data gagal diupdate.']);
        }
    }
}
