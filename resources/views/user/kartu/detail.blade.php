@extends("layouts.master")

@section("title", "Detail Kartu")

@section("content")
    <div class="content content-inner">
        <section class="section-content-profile">

            <div class="card-user mb-4">
                <div class="card-user-header mb-4">
                    <p class="text-responsive text-center">KEPOLISIAN NEGARA REPUBLIK INDONESIA</p>
                    <p class="text-responsive text-center">DAERAH JAWA BARAT</p>
                    <p class="text-responsive mb-3 text-center">RESOR CIANJUR</p>
                </div>

                <div class="card-user-body">
                    <h4 class="text-responsive mb-4 text-center">KARTU PEMEGANG SENJATA API DIGITAL</h4>

                    <div class="card-user-body-content">
                        <div class="card-logo-wrapper">
                            <div class="card-logo-wrapper-polri">
                                <img id="image" class="card-user-polri" src="{{ asset('assets/images/logo-polri.png') }}"
                                    alt="Polri">
                            </div>
                            <img id="image-foto-pribadi" class="card-user-profile" src="{{ asset($card->foto_pribadi ? $card->foto_pribadi : 'assets/images/user.png') }}"
                                alt="User">
                        </div>

                        <div style="width: 100%">
                            <div class="card-content-data">
                                <div class="card-content-data-field text-responsive">
                                    <div class="mb-3">
                                        <span>Nama:</span>
                                    </div>
                                    <div class="mb-3">
                                        <span>NRP:</span>
                                    </div>
                                    <div class="mb-3">
                                        <span>Pangkat:</span>
                                    </div>
                                    <div class="mb-3">
                                        <span>Jabatan:</span>
                                    </div>
                                    <div class="mb-3">
                                        <span>Kesatuan:</span>
                                    </div>
                                </div>

                                <div class="card-content-data-field-value text-responsive">
                                    <div class="mb-3">
                                        <span>{{ $card->nama ?? "-" }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span>{{ $card->nrp ?? "-" }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span>{{ $card->pangkat ?? "-" }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span>{{ $card->jabatan ?? "-" }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span>{{ $card->kesatuan ?? "-" }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="content-approver">
                                <p>KEPALA KEPOLISIAN RESOR CIANJUR POLDA JABAR</p>
                                <p style="border-bottom: 1px solid #000">{{$card->update_by }}</p>
                                {{-- <p>Ajun Ajudan Polisi NRP 0012</p> --}}
                            </div>
                        </div>

                    </div>
                    <div class="card-user-footer">
                        <p class="text-responsive">BERLKAU S/D {{ $card->berlaku_sampai_dengan }}</p>
                    </div>

                </div>
            </div>

            <div class="card-user">
                <div class="card-weapon">
                    <div id="data-senjata-api">
                        <p class="text-responsive">DATA SENJATA API</p>
                        <div class="card-content-senajata-api">
                            <div class="card-content-data-field text-responsive">
                                <div class="mb-3">
                                    <span>Jenis : {{ $card->jenis ?? "-" }}</span>
                                </div>
                                <div class="mb-3">
                                    <span>Type : {{ $card->type ?? "-" }}</span>
                                </div>
                                <div class="mb-3">
                                    <span>Nomor : {{ $card->nomor ?? "-" }}</span>
                                </div>
                                <div class="mb-3">
                                    <span>Kaliber : {{ $card->kaliber ?? "-" }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="data-ketentuan">
                        <p class="text-responsive">Ketentuan: </p>
                        <p class="mb-3">
                            -
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
