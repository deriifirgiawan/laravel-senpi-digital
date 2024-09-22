<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Personil;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function Index()
    {
        return view('user.profile.index');
    }

    public function Update(Request $request)
    {
        $personil_id = $request->user()->personil_id;
        $request->validate([
            'foto_pribadi' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nrp' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'pangkat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kesatuan' => 'required|string|max:255',
        ]);
        $personilData = [
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'kesatuan' => $request->kesatuan,
        ];
        try {
            $personil = Personil::findOrFail($personil_id);
            if ($request->hasFile('foto_pribadi')) {
                $avatarName = time() . '.' . $request->foto_pribadi->extension();
                $request->foto_pribadi->move(public_path('assets/images/user'), $avatarName);
                $personilData['foto_pribadi'] = "assets/images/user/" . $avatarName;
            }
            $personil->update($personilData);
            return redirect()->route('profile')->with('success', 'Data berhasil diupdate.');
        } catch (\Throwable $th) {
            return redirect()->route('profile')->with('error', 'Data gagal diupdate.');
        }
    }
}
