@extends("layouts.master")

@section("title", "Profile")

@section("content")
    <div class="content content-inner">
        <section class="section-content">
            <div class="table-responsive">
                <table id="datatable" class="table-striped table" data-toggle="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Kartu</th>
                            <th>NRP</th>
                            <th>Senjata</th>
                            <th>Personil</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cards as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_kartu }}</td>
                                <td>{{ $item->nrp}}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->tanggal_update }}</td>
                                <td>
                                    <a href="{{ route("kartu-detail", ['id' => $item->id]) }}" class="text-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
