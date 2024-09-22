@extends("layouts.master")
@extends("partials.modal")
@section("title", "Upload Test")

@section("content")
    <div class="content content-inner">
        <div class="section-content">
            <div class="mb-3 text-end">
                <a href="{{ route("staff-it-upload-test.add") }}" class="btn btn-primary"> <i class="bi bi-plus-circle"></i>
                    Tambah</a>
            </div>
            <div class="table-responsive">
                <table id="datatable" class="table-striped table" data-toggle="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Test</th>
                            <th>NRP</th>
                            <th>Nama Personil</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tes as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->personil->nrp }}</td>
                                <td>{{ $data->personil->nama }}</td>
                                <td>
                                    <a class="text-warning text-action"
                                        href="{{ route("staff-it-upload-test.edit", $data->id) }}">Edit</a>
                                    <form action="{{ route("staff-it-upload-test.delete", $data->id) }}" method="POST"
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
@endsection
