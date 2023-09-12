@extends('master')

@section('konten')
</br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    Edit Data
                    <a href="{{ url('/admin') }}" class="float-right btn btn-sm btn-primary">Kembali</a>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ url('/admin/update/'.$admin->id) }}">

                        @csrf

                        {{ method_field('PUT') }}

                        <div class="form-group">

                            <label>Divisi</label>
                            <select class="form-control" name="divisi" id="">
                                <option value="">-Pilih Divisi</option>
                                <option <?php if ($admin->divisi == "Teknologi Informasi") {
                                            echo "selected='selected'";
                                        } ?> value="Teknologi Informasi">Teknologi Informasi</option>
                                <option <?php if ($admin->divisi == "SDM") {
                                            echo "selected='selected'";
                                        } ?> value="SDM">SDM</option>
                                <option <?php if ($admin->divisi == "Pemasaran") {
                                            echo "selected='selected'";
                                        } ?> value="Pemasaran">Pemasaran</option>
                            </select>

                            @if($errors->has('divisi'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('divisi') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="form-group">

                            <label>Jumlah Pegawai</label>
                            <input type="number" name="jumlahpegawai" class="form-control" value="{{$admin->jumlahpegawai}}">

                            @if($errors->has('jumlahpegawai'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('jumlahpegawai') }}</strong>
                            </span>
                            @endif

                        </div>

                        <div class="form-group">

                            <label>Juz Ke</label>
                            <input type="number" name="jus_ke" class="form-control" value="{{$admin->jus_ke}}">

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