@extends('master')

@section('konten')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    Tambah Pembagian

                    <a href="{{ url('/admin') }}" class="float-right btn btn-sm btn-primary">Kembali</a>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ url('/admin/aksi') }}">

                        @csrf

                        <div class="form-group">

                            <label>Divisi</label>
                            <select name="divisi" class="form-control" id="">
                                <option value="">-Pilih Divisi</option>
                                <option value="Teknologi Informasi">Teknologi Informasi</option>
                                <option value="SDM">SDM</option>
                                <option value="Pemasaran">Pemasaran</option>
                            </select>

                            @if($errors->has('divisi'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('divisi') }}</strong>
                            </span>
                            @endif

                        </div>

                        <div class="form-group">

                            <label>Jumlah Pegawai</label>
                            <input type="number" name="jumlahpegawai" class="form-control">

                            @if($errors->has('jumlahpegawai'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('jumlahpegawai') }}</strong>
                            </span>
                            @endif

                        </div>

                        <div class="form-group">

                            <label>Juz Ke</label>
                            <input type="number" name="jus_ke" class="form-control">

                            @if($errors->has('jus_ke'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('jus_ke') }}</strong>
                            </span>
                            @endif

                        </div>

                        <input type="submit" class="btn btn-primary" value="Simpan">

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection