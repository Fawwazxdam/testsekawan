@extends('layouts.app')
@section('content')
    <h2 class="text-center">Kendaraan</h2>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Kendaraan</th>
                <th scope="col">Pabrikan</th>
                <th scope="col">Jenis BBM</th>
                <th scope="col">Foto</th>
                <th scope="col">Kategori</th>
                <th scope="col">Status</th>
                <th scope="col" colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $kendaraan)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $kendaraan->nama_kendaraan }}</td>
                    <td>{{ $kendaraan->pabrikan }}</td>
                    <td>{{ $kendaraan->bbm }}</td>
                    <td><img src="{{ asset('storage/'.$kendaraan->foto) }}" alt="" width="100px"></td>
                    <td>{{ $kendaraan->kategori->nama_kategori }}</td>
                    <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit{{$kendaraan->id}}">Edit</button></td>
                    <td><a href="{{url('delken/'.$kendaraan->id)}}"><button type="button" class="btn btn-danger">Delete</button></a></td>
                </tr>

                {{-- BEGIN MODAL EDIT --}}
                <div class="modal fade" id="edit{{$kendaraan->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark">
                            <div class="modal-header">
                                <h3 class="modal-title fs-5" id="exampleModalLabel">Update kendaraan</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('kendaraan.update',$kendaraan->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label class="form-label">Nama kendaraan</label>
                                        <input type="text" class="form-control" name="nama_kendaraan" value="{{$kendaraan->nama_kendaraan}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Pabrikan</label>
                                        <input type="text" class="form-control" name="pabrikan" value="{{$kendaraan->pabrikan}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jenis BBM</label>
                                        <select class="form-control" name="bbm">
                                            {{-- <option disabled selected>Pilih Jenis BBM</option> --}}
                                            <option selected value="{{$kendaraan->bbm}}">{{$kendaraan->bbm}}</option>
                                            <option value="Bensin">Bensin</option>
                                            <option value="Disel">Disel</option>
                                            <option value="Listrik">Listrik</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Foto</label><br>
                                        <img src="{{ asset('storage/'.$kendaraan->foto) }}" alt="" width="300px">
                                        <input type="file" class="form-control mt-3" name="foto">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                                        <select class="form-control" name="kategori_id">
                                            <option value="" >Pilih Kategori</option>
                                            @foreach ($data2 as $item)
                                            <option value="{{ $item->id }}" @selected($kendaraan->kategori_id==$item->id) >{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Sumbit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END MODAL EDIT --}}

            @endforeach
        </tbody>
    </table>
    
    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Tambah kendaraan</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kendaraan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama kendaraan</label>
                        <input type="text" class="form-control" name="nama_kendaraan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pabrikan</label>
                        <input type="text" class="form-control" name="pabrikan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis BBM</label>
                        <select class="form-control" name="bbm">
                            <option disabled selected>Pilih Jenis BBM</option>
                            <option value="Bensin">Bensin</option>
                            <option value="Disel">Disel</option>
                            <option value="Listrik">Listrik</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" class="form-control" name="foto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-control" name="kategori_id">
                            <option disabled selected>Pilih Kategori</option>
                            @foreach ($data2 as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Sumbit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection