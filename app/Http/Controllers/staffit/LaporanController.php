<?php

namespace App\Http\Controllers\staffit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use App\Models\KartuPengajuan;
use App\Models\Personil;
use App\Models\Weapon;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class LaporanController extends Controller
{
    public function Index(Request $request)
    {
        return view('staffit.laporan.index');
    }

    public function generateReport(Request $request)
    {
        $type_laporan = $request->input('type_laporan');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $type = $request->input('type', 'excel');
        $data = [];
        $headings = [];
        $title = '';

        switch ($type_laporan) {
            case 'Weapon':
                $data = Weapon::select(
                    'jenis',
                    'type',
                    'nomor',
                    'kaliber'
                )->whereBetween('created_at', [$start_date, $end_date])->get();
                $headings = [
                    'jenis',
                    'type',
                    'nomor',
                    'kaliber'
                ];
                $title = 'Laporan Senjata';
                $nameFile = "Report Senjata $start_date - $end_date";
                break;
            case 'Personil':
                $data = Personil::select(
                    'nrp',
                    'nama',
                    'pangkat',
                    'jabatan',
                    'kesatuan',
                )->whereBetween('created_at', [$start_date, $end_date])->get();
                $nameFile = "Report Personil $start_date - $end_date";
                $headings = [
                    'nrp',
                    'nama',
                    'pangkat',
                    'jabatan',
                    'kesatuan',
                ];
                $title = 'Laporan Personil';
                break;
            case 'Kartu':
                $data = KartuPengajuan::query()
                    ->select(
                        'kartu_pengajuan.kode_kartu',
                        'kartu_pengajuan.tanggal_update',
                        'kartu_pengajuan.status',
                        'personil.nrp',
                        'personil.nama',
                        'personil.pangkat',
                        'personil.jabatan',
                        'personil.kesatuan',
                        'weapon.jenis',
                        'weapon.type',
                        'weapon.nomor',
                        'weapon.kaliber'
                    )
                    ->leftJoin('personil', 'kartu_pengajuan.id_personil', '=', 'personil.id_personil')
                    ->leftJoin('weapon', 'kartu_pengajuan.id_senjata', '=', 'weapon.id')
                    ->where('kartu_pengajuan.status', '=', 'Diterima')
                    ->whereBetween('tanggal_update', [$start_date, $end_date])
                    ->get();
                $headings = [
                    'kode_kartu',
                    'tanggal_update',
                    'status',
                    'nrp',
                    'nama',
                    'pangkat',
                    'jabatan',
                    'kesatuan',
                    'jenis',
                    'type',
                    'nomor',
                    'kaliber'
                ];
                $title = 'Laporan Kartu';
                $nameFile = "Report Kartu $start_date - $end_date";
                break;
            default:
                $data = [];
                $headings = [];
                $nameFile = "";
                break;
        }
        if ($data->isEmpty()) {
            return redirect()->route('staff-it-laporan')->with('error', 'Data Tidak Ada');
        }

        // Export data to Excel
        if ($type === 'pdf') {
            $pdf = FacadePdf::loadView('reports.pdf', [
                'title' => $title,
                'headings' => $headings,
                'data' => $data,
                'start_date' => $start_date,
                'end_date' => $end_date
            ]);
            $pdf->setPaper('a4', 'landscape');
            return $pdf->download('report.pdf');
        } else {
            return Excel::download(new ReportExport($data, $headings, $title, $start_date, $end_date), $nameFile . '.xlsx');;
        }
    }
}
