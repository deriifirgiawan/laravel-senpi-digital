@extends("layouts.master-auth")
@section("content")
    <div class="container">
        <div class="wrapper">
            <form method="POST" action="{{ route("login") }}">
                @csrf
                <section class="card">
                    @error("username_or_email")
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    @error("password")
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
                        <input type="text" class="form-control mb-3" id="username_or_email"
                            placeholder="Username or Email" name="username_or_email">
                        <input type="password" class="form-control mb-3" id="password" placeholder="Password" name="password">
                        <a href="{{route("forgot-password")}}" class="text-primary">Lupa Password ?</a>
                        <button class="btn btn-primary" type="submit">Login</button>
                        <a href="{{route("register")}}" class="btn">Register</a>
                    </div>
                </section>
            </form>
        </div>
    </div>
@endsection
