@extends('layouts.nav')
@section('content')
    <main>
        {{-- CAROUSEL --}}
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card bg-gradient-primary" style="width: 100%; height: 50vh;">
                        <div class="card-body">
                            <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                <h1 class="text-light">Nikel Vehicle Rent (NVR)</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card bg-gradient-info" style="width: 100%; height: 50vh;">
                        <div class="card-body">
                            <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                <h1 class="text-light">Best Place to rent vehicle</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card bg-gradient-success" style="width: 100%; height: 50vh;">
                        <div class="card-body">
                            <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                <h1 class="text-light">Have a great day !</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        {{-- REGISTER FORM --}}
        <h3 class="text-center mt-4">Ayo Mulai !</h3>
        <div class="container">
            <div class="card border-left-primary shadow h-100 py-2 mb-3">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <form action="{{url('daftar')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label text-primary">Nama</label>
                                    <input type="text" class="form-control" name="nama_cust" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">No. HP</label>
                                    <input type="number" class="form-control" name="nohp" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Sewa</label>
                                    <input type="date" class="form-control" name="tanggal_sewa" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Kembali</label>
                                    <input type="date" class="form-control" name="tanggal_kembali" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kendaraan</label>
                                    <div class="form-check mb-3">
                                        @foreach ($data as $kendaraan)
                                            <input type="radio" class="btn-check" name="kendaraan_id"
                                                value="{{ $kendaraan->id }}" id="{{ $kendaraan->id }}"
                                                autocomplete="off">
                                            <label class="btn btn-outline-primary"
                                                for="{{ $kendaraan->id }}">{{ $kendaraan->nama_kendaraan }}<br />
                                                <img src="{{ asset('storage/' . $kendaraan->foto) }}" alt=""
                                                    width="90px">
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Driver</label>
                                    <select class="form-control" name="driver_id">
                                        <option disabled selected>Pilih Driver</option>
                                        @foreach ($data2 as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->nama_driver }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Syarat & Ketentuan</label><br>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#approval1">Baca S&K</button>
                                    <div class="mt-3 form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="aprv1"
                                            name="approval1" value="1">
                                        <label class="form-check-label" for="aprv1">Saya Setuju</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- MODAL S&K --}}
    <div class="modal fade" id="approval1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Syarat dan
                        Ketentuan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>1. Jangan Merusak Mobil</p>
                    <p>2. Jangan Mencuri Mobil</p>
                    <p>3. Mobil dikembalikan sesuai tanggal pengembalian</p>
                    <p>4. Peminjam akan dikenai denda jika terjadi kerusakan atau melanggar
                        kesepakatan yang telah dibuat</p>
                    <p><b><i>dengan menyetujui persetujuan ini berarti anda setuju dengan
                                kebijakan tanpa adanya paksaan dari pihak manapun</i></b>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
