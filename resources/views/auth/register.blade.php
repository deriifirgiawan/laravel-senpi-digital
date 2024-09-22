@extends("layouts.master-auth")
@section("content")
    <div class="container">
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
        <div class="wrapper">
            <form method="POST" action="{{ route("register") }}">
                @csrf
                <section class="card">
                    <div class="card-login">
                        <div class="logo-wrapper">
                            <img src="{{ asset("assets/images/icons/logo.png") }}" style="width: 138px" />
                            <p class="mt-3 text-center">
                                Registrasi Akun
                            </p>
                        </div>
                        <div class="wrapper-nrp mb-3">
                            <div class="wrapper-nrp-input">
                                <input type="text" class="form-control" id="nrp" placeholder="NRP" name="nrp"
                                        >
                            </div>
                            <div class="wrapper-nrp-btn">
                                <button type="button" onclick="onSearch()" class="btn" id="searchBtn">
                                    <span>
                                        <i class="bi bi-search"></i>
                                    </span>
                                </button>
                            </div>
                        </div>

                        <input type="text" class="form-control mb-3" id="nama" placeholder="Nama" name="nama"
                            >

                        <input type="text" class="form-control mb-3" id="pangkat" placeholder="Pangkat" name="pangkat"
                            >

                        <input type="text" class="form-control mb-3" id="jabatan" placeholder="Jabatan" name="jabatan"
                            >

                        <input type="text" class="form-control mb-3" id="kesatuan" placeholder="Kesatuan"
                            name="kesatuan" >

                        <input type="text" class="form-control mb-3" id="email" placeholder="Email" name="email"
                            >

                        <input type="text" class="form-control mb-3" id="username" placeholder="Username"
                            name="username">

                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">

                        <div class="card-login-footer">
                            <a class="btn" href="{{ route("login") }}">Kembali</a>
                            <button class="btn btn-success" type="submit">Daftar</button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function onSearch() {
            const nrp = document.getElementById("nrp").value;
            $.get("{{ url("search-nrp") }}?nrp=" + nrp, function(data) {
                if (data.data !== null) {
                    if (data.can_register) {
                        $('#nama').val(data.data.nama);
                        $('#pangkat').val(data.data.pangkat);
                        $('#jabatan').val(data.data.jabatan);
                        $('#kesatuan').val(data.data.kesatuan);
                    } else {
                        alert('Maaf anda sudah Memiliki akun Silahkan Login')
                    }
                } else {
                    // alert('Maaf akun tidak ditemukan, silahkan minta admin untuk menambah akun anda')
                }
            });
        }
    </script>
@endsection
