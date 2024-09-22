@extends("layouts.master-auth")
@section("content")
    @if (session("error"))
        <div id="error-messages" class="position-absolute fade-out end-0 top-10 p-3" style="z-index: 1000;">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session("error") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="wrapper">
            <form method="POST"
                action="{{ route("forgot-password.change-password-update-password") }}?id_akun={{ request()->query("id_akun") }}"
                id="changePasswordForm">
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
                        <input type="password" class="form-control mb-3" id="password" placeholder="Masukan Password Baru"
                            name="password">
                        <input type="password" class="form-control mb-3" id="confirm_password"
                            placeholder="Masukan Lagi Password" name="confirm_password">
                        <button class="btn btn-success" type="submit">Kirim</button>
                    </div>
                </section>
            </form>
        </div>
    </div>
@endsection
