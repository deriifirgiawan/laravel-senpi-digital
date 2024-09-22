<?php

namespace App\Http\Controllers\staffit;

use App\Http\Controllers\Controller;
use App\Models\Weapon;
use Illuminate\Http\Request;

class WeaponController extends Controller
{
    public function index(Request $request)
    {
        $weapons = Weapon::all();
        return view('staffit.weapon.index', compact('weapons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'type' => 'required',
            'nomor' => 'required',
            'kaliber' => 'required'
        ]);

        Weapon::create($request->all());

        return redirect()->route('staff-it-senjata-api.index')->with('success', 'Senjata Berhasil ditambahkan');
    }

    public function edit($id)
    {
        $weapon = Weapon::find($id);
        return response()->json($weapon);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required',
            'type' => 'required',
            'nomor' => 'required',
            'kaliber' => 'required'
        ]);
        $weapon = Weapon::findOrFail($id);
        $weapon->fill($request->all());
        $weapon->save();

        return redirect()->route('staff-it-senjata-api.index')->with('success', 'Senjata Berhasil diupdate');
    }

    public function destroy(Request $request, $id)
    {
        $weapon = Weapon::find($id);

        if (!$weapon) {
            return redirect()->route('staff-it-senjata-api.index')->with('error', 'Data tidak ditemukan.');
        }
        $weapon->delete();
        return redirect()->route('staff-it-senjata-api.index')->with('success', 'Senjata Berhasil dihapus');
    }
}
