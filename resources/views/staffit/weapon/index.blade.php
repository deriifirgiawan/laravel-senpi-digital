@extends("layouts.master")
@extends("partials.modal")

@section("title", "Senjata Api")

@section("content")
    <div class="content content-inner">
        <div class="section-content">
            <div class="mb-3 text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah"> <i class="bi bi-plus-circle"></i> Tambah</button>
            </div>
            <div class="table-responsive">
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Type</th>
                        <th>Nomor</th>
                        <th>Kaliber</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($weapons as $weapon)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $weapon->jenis }}</td>
                                <td>{{ $weapon->type }}</td>
                                <td>{{ $weapon->nomor }}</td>
                                <td>{{ $weapon->kaliber }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="text-warning text-action" data-id="{{ $weapon->id }}" onclick="editSenjata(this)">Edit</a>
                                    <form action="{{ route('staff-it-senjata-api.destroy', $weapon->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger text-action p-0 m-0">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Data --}}
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('staff-it-senjata-api.store') }}">
                    @csrf
                    <div class="modal-body">
                        <h3 class="text-center mb-4">Tambah Data Senjata Api</h3>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis<span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Masukan Jenis" required>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type<span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="type" id="type" placeholder="Masukan Type" required>
                        </div>

                        <div class="mb-3">
                            <label for="nomor" class="form-label">Nomor<span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="nomor" id="nomor" placeholder="Masukan Nomor" required>
                        </div>

                        <div class="mb-3">
                            <label for="kaliber" class="form-label">Kaliber<span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="kaliber" id="kaliber" placeholder="Masukan Kaliber" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Data --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editJenis" class="form-label">Jenis<span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="jenis" id="editJenis" placeholder="Masukan Jenis" required>
                        </div>

                        <div class="mb-3">
                            <label for="editType" class="form-label">Type<span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="type" id="editType" placeholder="Masukan Type" required>
                        </div>

                        <div class="mb-3">
                            <label for="editNomor" class="form-label">Nomor<span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="nomor" id="editNomor" placeholder="Masukan Nomor" required>
                        </div>

                        <div class="mb-3">
                            <label for="editKaliber" class="form-label">Kaliber<span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="kaliber" id="editKaliber" placeholder="Masukan Kaliber" required>
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
        function editSenjata(element) {
            var id = $(element).data('id');
            $.get("{{ url('staff-it/senjata-api') }}/" + id + "/edit", function(data) {
                console.log(data.jenis);
                $('#editForm').attr('action', "{{ url('staff-it/senjata-api') }}/" + id);
                $('#editJenis').val(data.jenis);
                $('#editType').val(data.type);
                $('#editNomor').val(data.nomor);
                $('#editKaliber').val(data.kaliber);
                $('#editModal').modal('show');
            });
        }
    </script>
@endsection
