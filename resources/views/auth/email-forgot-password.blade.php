@extends("layouts.master-auth")
@section("content")
    <div class="container">
        @if (session("success"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("success") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session("error"))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session("error") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="wrapper">
            <form method="POST" action="{{ route("send-forgot-password") }}">
                @csrf
                <section class="card">
                    @error("email")
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    <div class="card-login">
                        <div class="logo-wrapper">
                            <img src="{{ asset("assets/images/icons/logo.png") }}" style="width: 138px" />
                            <p class="mt-3 text-center">
                                Kartu Pemegang Senpi Digital
                            </p>
                        </div>
                        <input type="text" class="form-control mb-3" id="email" placeholder="Masukan Email"
                            name="email">
                        <button class="btn btn-primary" type="submit">Kirim</button>
                        <a href="{{ route("login") }}" class="btn">Kembali</a>
                    </div>
                </section>
            </form>
        </div>
    </div>
@endsection
