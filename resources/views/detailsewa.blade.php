@extends('layouts.nav')
@section('content')
    {{-- REGISTER FORM --}}
    <h3 class="text-center mt-4">Detail Penyewaan</h3>
    <div class="container">
        <div class="card border-left-primary shadow h-100 p-2 mb-3">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="mb-3">
                            <label class="form-label text-primary">Nama</label>
                            <h4>{{ $detail->nama_cust }}</h4>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-primary">No. HP</label>
                            <h4>{{ $detail->nohp }}</h4>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-primary">Tanggal Sewa</label>
                            <h4>{{ $detail->tanggal_sewa }}</h4>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-primary">Tanggal Kembali</label>
                            <h4>{{ $detail->tanggal_kembali }}</h4>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-primary">Kendaraan</label>
                            <h4>{{ $detail->kendaraan->nama_kendaraan }}</h4>
                            <img src="{{ asset('storage/' . $detail->kendaraan->foto) }}" alt="" width="300px">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-primary">Driver</label>
                            <h4>{{ $detail->driver->nama_driver }}</h4>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-primary">Status</label>
                            <h4>{{ $detail->status }}</h4>
                        </div>
                    </div>
                    <a href="/index" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
