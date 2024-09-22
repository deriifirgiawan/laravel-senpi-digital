@extends("layouts.master")

@section("title", "Home Page")

@section("content")
    <div class="content content-inner">
        <div class="section-content">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="bg-primary rounded p-3 text-white">
                                    <i class="bi bi-person"></i>
                                </div>
                                <div class="text-end">
                                    Total Jumlah Akun
                                    <h2 class="counter">{{ $count_akun }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="bg-info rounded p-3 text-white">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="text-end">
                                    Total Jumlah Personil
                                    <h2 class="counter">{{ $count_personil }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="bg-info rounded p-3 text-white">
                                    <i class="bi bi-crosshair2"></i>
                                </div>
                                <div class="text-end">
                                    Total Jumlah Senjata
                                    <h2 class="counter">{{ $count_weapon }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
