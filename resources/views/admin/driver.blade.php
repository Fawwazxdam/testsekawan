@extends('layouts.app')
@section('content')
    <h2 class="text-center">Driver</h2>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Driver</th>
                <th scope="col">Usia</th>
                <th scope="col">Foto</th>
                <th scope="col" colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $driver)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $driver->nama_driver }}</td>
                    <td>{{ $driver->usia }}</td>
                    <td><img src="{{ asset('storage/'.$driver->foto_driver) }}" alt="" width="100px"></td>
                    <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit{{$driver->id}}">Edit</button></td>
                    <td><a href="{{url('deldri/'.$driver->id)}}"><button type="button" class="btn btn-danger">Delete</button></a></td>
                </tr>

                {{-- BEGIN MODAL EDIT --}}
                <div class="modal fade" id="edit{{$driver->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark">
                            <div class="modal-header">
                                <h3 class="modal-title fs-5" id="exampleModalLabel">Update driver</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('driver.update',$driver->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label class="form-label">Nama Driver</label>
                                        <input type="text" class="form-control" name="nama_driver" value="{{$driver->nama_driver}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Usia</label>
                                        <input type="number" class="form-control" name="usia" value="{{$driver->usia}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Foto</label><br>
                                        <img src="{{ asset('storage/'.$driver->foto_driver) }}" alt="" width="300px">
                                        <input type="file" class="form-control mt-3" name="foto">
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
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Tambah driver</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('driver.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Driver</label>
                        <input type="text" class="form-control" name="nama_driver" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Usia</label>
                        <input type="number" class="form-control" name="usia" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" class="form-control" name="foto_driver" required>
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