@extends("layouts.master")

@section("title", "Pengajuan")

@section("content")
    <div class="content content-inner">
        <section class="section-content-profile">
            <div class="card mb-3">
                <form method="POST" action="{{ route("pengajuan.post") }}">
                    @csrf
                    <div class="card-body section-edit-profile">
                        <h4 class="mb-4">Data Senjata</h4>

                        <div class="mb-3">
                            <label for="weapon" class="form-label">Jenis<span style="color: red">*</span></label>
                            <select id="weapon" class="form-select" name="weapon" aria-label="Default select example" required>
                                <option value="" selected>Pilih Jenis Senjata</option>
                                @foreach ($weapons as $weapon)
                                    <option value="{{ $weapon }}" data-jenis="{{ $weapon->jenis }}">{{ $weapon->jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type<span style="color: red">*</span></label>
                            <select id="type" class="form-select" aria-label="Default select example" disabled>
                                <option value="" selected>Pilih Type Senjata</option>
                                @foreach ($weapons as $weapon)
                                    <option value="{{ $weapon->type }}" data-jenis="{{ $weapon->type }}">{{ $weapon->type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nomor" class="form-label">Nomor<span style="color: red">*</span></label>
                            <select id="nomor" class="form-select" aria-label="Default select example" disabled>
                                <option value="" selected>Pilih Nomor Senjata</option>
                                @foreach ($weapons as $weapon)
                                    <option value="{{ $weapon->nomor }}" data-jenis="{{ $weapon->nomor }}">{{ $weapon->nomor }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="kaliber" class="form-label">Kaliber<span style="color: red">*</span></label>
                            <select id="kaliber" class="form-select" aria-label="Default select example" disabled>
                                <option value="" selected>Pilih Kaliber Senjata</option>
                                @foreach ($weapons as $weapon)
                                    <option value="{{ $weapon->kaliber }}" data-jenis="{{ $weapon->kaliber }}">{{ $weapon->kaliber }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="test_id" class="form-label">Hasil Test<span style="color: red">*</span></label>
                            <select id="test_id" name="test_id" class="form-select" aria-label="Default select example" required>
                                <option value="" selected>Pilih Hasil Test</option>
                                @foreach ($test as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="section-footer-pengajuan">
                            <a class="btn btn-danger" href="{{route("pengajuan")}}">Batal</a>
                            <button class="btn btn-primary" type="submit">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script>
        document.getElementById('weapon').addEventListener('change', function () {
            var selectedJenis = this.value;

            var typeSelect = document.getElementById('type');
            var nomorSelect = document.getElementById('nomor');
            var kaliberSelect = document.getElementById('kaliber');
            const convertToJson = JSON.parse(selectedJenis);
            typeSelect.value = convertToJson.type;
            nomorSelect.value = convertToJson.nomor;
            kaliberSelect.value = convertToJson.kaliber;
            selectedJenis.value = selectedJenis.id;
        });
    </script>
@endsection
