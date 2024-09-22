@extends("layouts.master")

@section("title", "Profile")

@section("content")
    <div class="content content-inner">
        <section class="section-content-profile">
            <form method="POST" action="{{ route("profile.update") }}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="card mb-3">
                    <div class="card-body section-edit-profile">
                        <div class="mb-3 text-center">
                            <img id="image-foto-pribadi"
                                src="{{ auth()->user()->personil->foto_pribadi ? asset(auth()->user()->personil->foto_pribadi) : asset("assets/images/user.png") }}"
                                alt="User" style="max-width: 200px;">
                            <br>
                            <br>
                            <input type="file" id="foto_pribadi" name="foto_pribadi">
                        </div>

                        <div class="mb-3">
                            <label for="nrp" class="form-label">NRP<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="nrp" placeholder="Masukan NRP"
                                name="nrp" required value="{{ auth()->user()->personil->nrp }}">
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="nama" placeholder="Masukan Nama"
                                name="nama" required value="{{ auth()->user()->personil->nama }}">
                        </div>

                        <div class="mb-3">
                            <label for="pangkat" class="form-label">Pangkat<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="pangkat" placeholder="Masukan Pangkat"
                                name="pangkat" required value="{{ auth()->user()->personil->pangkat }}">
                        </div>

                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="jabatan" placeholder="Masukan Jabatan"
                                name="jabatan" required value="{{ auth()->user()->personil->jabatan }}">
                        </div>

                        <div class="mb-4">
                            <label for="kesatuan" class="form-label">Kesatuan<span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="kesatuan" placeholder="Masukan Kesatuan"
                                name="kesatuan" required value="{{ auth()->user()->personil->kesatuan }}">
                        </div>
                        <button class="btn btn-success">Ubah</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('foto_pribadi').addEventListener('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-foto-pribadi').src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection
