@extends('master')

@section('konten')
</br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    Form Input Pembagian
                    <a href="{{ url('/admin/tambah') }}" class="float-right btn btn-sm btn-primary">Tambah</a>
                </div>
                </br>

                <div class="card-body">

                    @if(Session::has('sukses'))
                    <div class="alert alert-success">
                        {{ Session::get('sukses') }}
                    </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Divisi</th>
                                <th>Jumlah Pegawai</th>
                                <th>Juz ke</th>
                                <th width="15%" class="text-center">OPSI</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php
                            $no = 1;
                            @endphp
                            @foreach($admin as $a)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{$a->divisi}}</td>
                                <td>{{ $a->jumlahpegawai }}</td>
                                <td>{{$a->jus_ke}}</td>
                                <td class="text-center">
                                    <a href="{{ url('/admin/edit/'.$a->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ url('/admin/hapus/'.$a->id) }}" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection