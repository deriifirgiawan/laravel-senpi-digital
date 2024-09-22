@extends("layouts.master")

@section("title", "Laporan")

@section("content")
    <div class="content content-inner">
        <form action="{{ route("staff-it-cetak-laporan") }}" method="get">
            @csrf
            <div class="section-content">
                <h4>Pilihan Cetak</h4>

                <div class="report-section mt-4">
                    <div class="report-section-label">
                        <span>Jenis Laporan</span>
                    </div>

                    <div class="report-section-input">
                        <select class="form-select" aria-label="jenis-laporan" name="type_laporan">
                            <option selected>Pilih Jenis Laporan</option>
                            <option value="Personil">Data Personil</option>
                            <option value="Weapon">Data Senjata</option>
                            <option value="Kartu">Data Pengajuan Kartu</option>
                        </select>
                    </div>
                </div>

                <div class="report-section mt-4">
                    <div class="report-section-label">
                        <span>Periode</span>
                    </div>

                    <div class="report-section-input">
                        <div class="row">
                            <div class="col-6">
                                <input class="form-control" type="date" name="start_date" id="from_date">
                            </div>
                            <div class="col-6">
                                <input class="form-control" type="date" name="end_date" id="from_date">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="report-section mt-4">
                    <div class="report-section-label">
                        <span>Tipe Data</span>
                    </div>

                    <div class="report-section-input form-input-checkbox">
                        <div class="form-check mr-4">
                            <input class="form-check-input" type="radio" name="type" value="pdf" id="type">
                            <label class="form-check-label" for="type">
                                Pdf
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" value="excel" id="type">
                            <label class="form-check-label" for="type">
                                Excel
                            </label>
                        </div>
                    </div>
                </div>

                <div class="report-section-footer">
                    <button class="btn btn-primary">Unduh</button>
                </div>
            </div>
        </form>
    </div>
@endsection
