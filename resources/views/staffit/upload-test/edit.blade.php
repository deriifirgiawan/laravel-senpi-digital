@extends("layouts.master")
@section("title", "Upload Test")
@section("content")
    <div class="content content-inner">
        @if ($errors->any())
            <div id="error-messages" class="position-absolute fade-out end-0 top-10 p-3" style="z-index: 1000;">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="section-content">
            <div class="mb-3 text-center">
                <h4>Tambah Test</h4>
            </div>
            <form action="{{ route("staff-it-upload-test.update", $tes->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Test<span style="color: red">*</span></label>
                    <input class="form-control" type="text" id="nama" name="nama" placeholder="Masukan Nama Test"
                        required value="{{ $tes->nama }}">
                </div>

                <div class="mb-3">
                    <label for="id_personil" class="form-label">Personil<span style="color: red">*</span></label>
                    <select name="id_personil" id="id_personil" class="form-control">
                        @foreach ($personil as $data)
                            <option value="{{ $data->id_personil }}"
                                {{ $data->id_personil == $tes->id_personil ? "selected" : "" }}>
                                {{ $data->nrp }} -{{ $data->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="test-kesehatan" class="form-label">Hasil Tes Kesehatan</label>
                            <input class="form-control mb-3" type="file" id="tes_kesehatan" name="tes_kesehatan"
                                onchange="updateFileLink('test-kesehatan', 'view-file-kesehatan')">
                            <a id="view-file-menembak" href="{{ asset($tes->hasil_kesehatan) }}" target="_blank">View
                                File</a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="test-psikologi" class="form-label">Hasil Tes Psikologi</label>
                            <input class="form-control mb-3" type="file" id="tes_psikologi" name="tes_psikologi"
                                onchange="updateFileLink('test-psikologi', 'view-file-psikologi')">
                            <a id="view-file-menembak" href="{{ asset($tes->hasil_psikologi) }}" target="_blank">View
                                File</a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="test-menembak" class="form-label">Hasil Tes Menembak</label>
                            <input class="form-control mb-3" type="file" id="tes_menembak" name="tes_menembak"
                                onchange="updateFileLink('test-menembak', 'view-file-menembak')">
                            <a id="view-file-menembak" href="{{ asset($tes->hasil_menembak) }}" target="_blank">View
                                File</a>
                        </div>
                    </div>
                </div>

                <div class="section-footer-pengajuan">
                    <a href="{{ route("staff-it-upload-test.index") }}" class="btn btn-danger">Batal</a>
                    <button class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function updateFileLink(inputId, linkId) {
            var input = document.getElementById(inputId);
            var file = input.files[0];
            var viewFileLink = document.getElementById(linkId);
            viewFileLink.textContent = 'View File';
            if (file) {
                viewFileLink.href = URL.createObjectURL(file);
            } else {
                viewFileLink.href = '#';
            }
        }
    </script>
@endsection
