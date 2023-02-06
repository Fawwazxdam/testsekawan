@extends('layouts.app')
@section('content')
    <h2 class="text-center">sewa</h2>
    <a href="{{url('export/sewa')}}" class="btn btn-primary mb-3"> Export to Excel</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID Sewa</th>
                <th scope="col">Nama Penyewa</th>
                <th scope="col">No. HP</th>
                <th scope="col">Tanggal Sewa</th>
                <th scope="col">Tanggal Kembali</th>
                <th scope="col">Status</th>
                <th scope="col" colspan="3" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $sewa)
                <tr>
                    <th scope="row">{{ $sewa->id }}</th>
                    <td>{{ $sewa->nama_cust }}</td>
                    <td>{{ $sewa->nohp }}</td>
                    <td>{{ $sewa->tanggal_sewa }}</td>
                    <td>{{ $sewa->tanggal_kembali }}</td>
                    <td>{{ $sewa->status }}</td>
                    @if($sewa->status !== 'Done')
                    <td><a href="{{url('selesai/'.$sewa->id)}}"><button type="button" class="btn btn-success">Done</button></a></td>
                    <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit{{$sewa->id}}">Edit</button></td>
                    @endif
                    <td><a href="{{url('delse/'.$sewa->id)}}"><button type="button" class="btn btn-danger">Delete</button></a></td>
                </tr>

                {{-- BEGIN MODAL EDIT --}}
                <div class="modal fade" id="edit{{$sewa->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark">
                            <div class="modal-header">
                                <h3 class="modal-title fs-5" id="exampleModalLabel">Update sewa</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('sewa.update',$sewa->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Nama</label>
                                        <input type="text" class="form-control" name="nama_cust" value="{{$sewa->nama_cust}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">No. HP</label>
                                        <input type="number" class="form-control" name="nohp" value="{{$sewa->nohp}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Sewa</label>
                                        <input type="date" class="form-control" name="tanggal_sewa" value="{{$sewa->tanggal_sewa}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Kembali</label>
                                        <input type="date" class="form-control" name="tanggal_kembali" value="{{$sewa->tanggal_kembali}}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kendaraan</label>
                                        <input type="text" class="form-control" value="{{$sewa->kendaraan->nama_kendaraan}}" required>
                                        <input type="text" class="form-control" name="kendaraan_id" value="{{$sewa->kendaraan_id}}" hidden>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Driver</label>
                                        <input type="text" class="form-control" value="{{$sewa->driver->nama_driver}}" required>
                                        <input type="text" class="form-control" name="driver_id" value="{{$sewa->driver_id}}" hidden>
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
    

@endsection