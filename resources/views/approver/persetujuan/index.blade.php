@extends("layouts.master")

@section("title", "Persetujuan")

@section("content")
    <div class="content content-inner">
        <div class="section-content">
            <div class="table-responsive">
                <table id="datatable" class="table-striped table" data-toggle="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>NRP</th>
                            <th>Jabatan</th>
                            <th>Jenis Senjata</th>
                            <th>Type</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listKartu as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->personil->nama }}</td>
                                <td>{{ $data->personil->nrp }}</td>
                                <td>{{ $data->personil->jabatan }}</td>
                                <td>{{ $data->senjata->jenis }}</td>
                                <td>{{ $data->senjata->type }}</td>
                                <td>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalPreview"
                                        class="text-warning text-action" data-id="{{ $data }}"
                                        onclick="previewPersetujuan(this)">Lihat</a>
                                    <span onclick="tolakPersetujuan(this)" class="text-danger text-action" data-reject={{$data->id}} data-bs-toggle="modal"
                                        data-bs-target="#modalReject">Tolak</span>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalReject" tabindex="-1" aria-labelledby="modalRejectLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('approver-persetujuan.reject') }}">
                    @csrf
                    <div class="modal-body">
                        <h4 class="mb-4">Tolak Persetujuan</h4>
                        <div>
                            <input style="display: none" id="reject_id" name="reject_id" />
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="rejectMessage" placeholder="Masukan Alasan" id="rejectMessage" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Alasan</label>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Preview --}}
    <div class="modal fade" id="modalPreview" tabindex="-1" aria-labelledby="modalPreviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-preview">
            <div class="modal-content">
                <form id="previewForm" method="POST">
                    @csrf
                    @method("put")
                    <div class="modal-body">
                        <h4>Persetujuan</h4>

                        <div class="approver-form-wrap">
                            <div class="approver-form-item">
                                <p class="mb-3">Data Diri</p>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama" disabled>
                                </div>

                                <div class="mb-3">
                                    <input type="text" class="form-control" name="nrp" id="nrp"
                                        placeholder="NRP" disabled>
                                </div>

                                <div class="mb-3">
                                    <input type="text" class="form-control" name="jabatan" id="jabatan"
                                        placeholder="Jabatan" disabled>
                                </div>
                            </div>

                            <div class="approver-form-item">
                                <p class="mb-3">Data Senjata Api</p>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="jenis" id="jenis"
                                        placeholder="Jenis" disabled>
                                </div>

                                <div class="mb-3">
                                    <input type="text" class="form-control" name="type" id="type"
                                        placeholder="Type" disabled>
                                </div>

                                <div class="mb-3">
                                    <input type="text" class="form-control" name="kaliber" id="kaliber"
                                        placeholder="Kaliber" disabled>
                                </div>
                            </div>

                        </div>

                        <div class="approver-preview-file">
                            <a id="view-file-kesehatan" href="#" target="_blank">View File Kesehatan</a>
                            <a id="view-file-psikologi" href="#" target="_blank">View File Kesehatan</a>
                            <a id="view-file-menembak" href="#" target="_blank">View File Kesehatan</a>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
                        <a class="btn btn-success" id="link-setuju">Setuju</a>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function previewPersetujuan(element) {
                const dataId = element.getAttribute('data-id');
                const data = JSON.parse(dataId);
                $('#nama').val(data.personil.nama);
                $('#nrp').val(data.personil.nrp);
                $('#jabatan').val(data.personil.jabatan);
                $('#jenis').val(data.senjata.jenis);
                $('#type').val(data.senjata.kaliber);
                $('#jenis').val(data.senjata.kaliber);
                $('#view-file-kesehatan').attr('href', `/${data.tes.hasil_kesehatan}`);
                $('#view-file-psikologi').attr('href', `/${data.tes.hasil_psikologi}`);
                $('#view-file-menembak').attr('href', `/${data.tes.hasil_menembak}`);
                $('#link-setuju').attr('href', `/approver/persetujuan/setuju/${data.id}`);
            }

            function tolakPersetujuan(element) {
                const dataId = element.getAttribute('data-reject');
                $('#reject_id').val(dataId)
            }
        </script>
    @endsection
