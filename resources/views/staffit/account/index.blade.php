@extends("layouts.master")
@extends("partials.modal")

@section("title", "Akun")

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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($akun as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->personil->nama }}</td>
                                <td>{{ $data->personil->nrp }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="text-warning text-action"
                                        data-id="{{ $data->id_akun }}" onclick="editAkun(this)">Edit</a>
                                    <form action="{{ route("staff-it-akun.delete", $data->id_akun) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit"
                                            class="btn btn-link text-danger text-action m-0 p-0">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route("staff-it-akun.post") }}">
                    @csrf
                    <div class="modal-body">
                        <h3 class="mb-4 text-center">Tambah Data Akun</h3>
                        <div class="mb-3">
                            <label for="personil_id" class="form-label">Personil<span style="color: red">*</span></label>
                            <select name="personil_id" id="personil_id" class="form-control" placeholder="Personil">
                                @foreach ($personilWithoutAkun as $data)
                                    <option value="{{ $data->id_personil }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="username" placeholder="Username" name="username"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email<span style="color: red">*</span></label>
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password<span style="color: red">*</span></label>
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                name="password">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role<span style="color: red">*</span></label>
                            <select name="role" id="role" class="form-control" placeholder="role">
                                <option value="staff-it">staff-it</option>
                                <option value="approver">approver</option>
                                <option value="user">user</option>
                            </select>
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
                    @method("PUT")
                    <div class="modal-body">
                        <h3 class="mb-4 text-center">Edit Data Akun</h3>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="edit_username" placeholder="Username"
                                name="username" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email<span style="color: red">*</span></label>
                            <input type="email" class="form-control" id="edit_email" placeholder="Email"
                                name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role<span style="color: red">*</span></label>
                            <select name="role" id="edit_role" class="form-control" placeholder="role">
                                <option value="staff-it">staff-it</option>
                                <option value="approver">approver</option>
                                <option value="user">user</option>
                            </select>
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
        function editAkun(element) {
            var id = $(element).data('id');
            $.get("{{ url("staff-it/akun") }}/" + id + "/edit", function(data) {
                $('#editForm').attr('action', "{{ url("staff-it/akun") }}/" + id + "/update");
                $('#edit_username').val(data.username);
                $('#edit_email').val(data.email);
                $('#edit_role').val(data.role).trigger('change');;
                $('#editModal').modal('show');
            });
        }
    </script>
@endsection
