<?php

namespace App\Http\Controllers\staffit;

use App\Http\Controllers\Controller;
use App\Models\Personil;
use App\Models\Tes;
use Illuminate\Http\Request;

class UploadTestController extends Controller
{
    public function Index()
    {
        $tes = Tes::all();
        return view('staffit.upload-test.index', compact('tes'));
    }

    public function showFormAdd()
    {
        $personil = Personil::all();
        return view('staffit.upload-test.add', compact('personil'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'tes_kesehatan' => 'file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
            'tes_psikologi' => 'file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
            'tes_menembak' => 'file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
            'id_personil' => 'required',
            'nama' => 'required',
        ]);
        $tesData = [
            'id_personil' => $request->id_personil,
            'nama' => $request->nama,
        ];

        if ($request->file('tes_kesehatan')) {
            $tesKesehatanName = time() . '.' . $request->tes_kesehatan->extension();
            $request->tes_kesehatan->move(public_path('assets/images/test-kesehatan/'), $tesKesehatanName);
            $tesData['hasil_kesehatan'] = "assets/images/test-kesehatan/" . $tesKesehatanName;
        }

        if ($request->file('tes_psikologi')) {
            $tesPsikologiName = time() . '.' . $request->tes_psikologi->extension();
            $request->tes_psikologi->move(public_path('assets/images/tes_psikologi/'), $tesPsikologiName);
            $tesData['hasil_psikologi'] = "assets/images/tes_psikologi/" . $tesPsikologiName;
        }

        if ($request->file('tes_menembak')) {
            $tesMenembakName = time() . '.' . $request->tes_menembak->extension();
            $request->tes_menembak->move(public_path('assets/images/tes_menembak/'), $tesMenembakName);
            $tesData['hasil_menembak'] = "assets/images/tes_menembak/" . $tesMenembakName;
        }
        try {
            Tes::create($tesData);
            return redirect()->route('staff-it-upload-test.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Throwable $th) {
            return redirect()->route('staff-it-upload-test.add')->with('error', "Data gagal disimpan.");
        }
    }
    public function edit($id)
    {
        $tes = Tes::find($id);
        $personil = Personil::all();
        return view('staffit.upload-test.edit', compact('tes', 'personil'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'tes_kesehatan' => 'file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
            'tes_psikologi' => 'file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
            'tes_menembak' => 'file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
            'id_personil' => 'required',
            'nama' => 'required',
        ]);
        $tesData = [
            'id_personil' => $request->id_personil,
            'nama' => $request->nama,
        ];

        if ($request->file('tes_kesehatan')) {
            $tesKesehatanName = time() . '.' . $request->tes_kesehatan->extension();
            $request->tes_kesehatan->move(public_path('assets/images/test-kesehatan/'), $tesKesehatanName);
            $tesData['hasil_kesehatan'] = "assets/images/test-kesehatan/" . $tesKesehatanName;
        }

        if ($request->file('tes_psikologi')) {
            $tesPsikologiName = time() . '.' . $request->tes_psikologi->extension();
            $request->tes_psikologi->move(public_path('assets/images/tes_psikologi/'), $tesPsikologiName);
            $tesData['hasil_psikologi'] = "assets/images/tes_psikologi/" . $tesPsikologiName;
        }

        if ($request->file('tes_menembak')) {
            $tesMenembakName = time() . '.' . $request->tes_menembak->extension();
            $request->tes_menembak->move(public_path('assets/images/tes_menembak/'), $tesMenembakName);
            $tesData['hasil_menembak'] = "assets/images/tes_menembak/" . $tesMenembakName;
        }
        try {
            $personil = Tes::findOrFail($id);
            $personil->update($tesData);
            return redirect()->route('staff-it-upload-test.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Throwable $th) {
            return redirect()->route('staff-it-upload-test.edit', $id)->with('error', "Data gagal disimpan.");
        }
    }

    public function destroy(Request $request, $id)
    {
        $tes = Tes::find($id);

        if (!$tes) {
            return redirect()->route('staff-it-upload-test.index')->with('error', 'Data tidak ditemukan.');
        }
        $tes->delete();
        return redirect()->route('staff-it-upload-test.index')->with('success', 'Senjata Berhasil dihapus');
    }
}
