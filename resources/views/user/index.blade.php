@extends("layouts.master")

@section("title", "Dashboard")

@section("content")
    <div class="content content-inner">
        <section class="section-content-profile">
            <div class="card mb-3">
                <div class="card-body section-profile-card">
                    <img id="image-foto-pribadi" class="mb-3"
                        src="{{ auth()->user()->personil->foto_pribadi ? asset(auth()->user()->personil->foto_pribadi) : asset("assets/images/user.png") }}"
                        alt="User" style="max-width: 200px;">
                    <h5 class="mb-3 text-center">{{ auth()->user()->personil->nama }}</h5>
                    <h5 class="mb-4 text-center">{{ auth()->user()->personil->nrp }}</h5>
                    <a class="btn btn-primary" href="{{ route("profile") }}">Profil</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body section-profile-card">
                    <i class="bi bi-file-arrow-up" style="font-size: 4rem"></i>
                    <a href="{{ route("pengajuan") }}">
                        <h5 class="mb-3 text-center">Pengajuan/Perpanjang Kartu Pemegang Senpi</h5>
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body section-profile-card">
                    <i class="bi bi-person-vcard" style="font-size: 4rem"></i>
                    <a href="{{ route("kartu") }}">
                        <h5 class="mb-3 text-center">Lihat Kartu Pemegang Senpi</h5>
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
