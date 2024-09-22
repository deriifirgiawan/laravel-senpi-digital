@extends("layouts.master")
@extends("partials.modal")
@section("title", "Personil")

@section("content")
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
    <div class="content content-inner">
        <div class="section-content">
            <div class="mb-3 text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah"> <i
                        class="bi bi-plus-circle"></i> Tambah</button>
            </div>
            <div class="table-responsive">
                <table id="datatable" class="table-striped table" data-toggle="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>NRP</th>
                            <th>Pangkat</th>
                            <th>Kesatuan</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personil as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->nrp }}</td>
                                <td>{{ $data->pangkat }}</td>
                                <td>{{ $data->kesatuan }}</td>
                                <td>{{ $data->jabatan }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="text-warning text-action"
                                        data-id="{{ $data->id_personil }}" onclick="editPersonil(this)">Edit</a>
                                    <form action="{{ route("staff-it-personil.delete", $data->id_personil) }}"
                                        method="POST" style="display:inline-block;">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit"
                                            class="btn btn-link text-danger text-action m-0 p-0">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach()
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route("staff-it-personil.post") }}">
                    @csrf
                    <div class="modal-body">
                        <h3 class="text-center mb-4">Tambah Data Personil</h3>
                        <div class="mb-3">
                            <label for="nrp" class="form-label">NRP<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="nrp" placeholder="Masukan NRP" name="nrp" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="nama" placeholder="Masukan Nama" name="nama" required>
                        </div>

                        <div class="mb-3">
                            <label for="pangkat" class="form-label">Pangkat<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="pangkat" placeholder="Masukan Pangkat" name="pangkat" required>
                        </div>

                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="jabatan" placeholder="Masukan Jabatan" name="jabatan" required>
                        </div>

                        <div class="mb-3">
                            <label for="kesatuan" class="form-label">Kesatuan<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="kesatuan" placeholder="Masukan Kesatuan"
                                name="kesatuan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                        <h3 class="text-center mb-4">Edit Data Personil</h3>
                        <div class="mb-3">
                            <label for="edit_nrp" class="form-label">NRP<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="edit_nrp" placeholder="Masukan NRP" name="nrp" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_nama" class="form-label">Nama<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="edit_nama" placeholder="Masukan Nama" name="nama" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_pangkat" class="form-label">Pangkat<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="edit_pangkat" placeholder="Masukan Pangkat"
                                name="pangkat" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_jabatan" class="form-label">Jabatan<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="edit_jabatan" placeholder="Masukan Jabatan" required
                                name="jabatan">
                        </div>

                        <div class="mb-3">
                            <label for="edit_kesatuan" class="form-label">Kesatuan<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="edit_kesatuan" placeholder="Masukan Kesatuan" required
                                name="kesatuan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editPersonil(element) {
            var id = $(element).data('id');
            $.get("{{ url("staff-it/personil") }}/" + id + "/edit", function(data) {
                $('#editForm').attr('action', "{{ url("staff-it/personil") }}/" + id + "/update");
                $('#edit_nrp').val(data.nrp);
                $('#edit_nama').val(data.nama);
                $('#edit_pangkat').val(data.pangkat);
                $('#edit_jabatan').val(data.jabatan);
                $('#edit_kesatuan').val(data.kesatuan);
                $('#editModal').modal('show');
            });
        }
    </script>
@endsection
