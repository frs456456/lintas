@extends('master')

@section('konten')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    Pengaturan

                    <a href="{{ url('/pengaturan') }}" class="float-right btn btn-sm btn-primary">Kembali</a>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ url('/pengaturan/aksi') }}">

                        @csrf


                        <div class="form-group">

                            <label>Tanggal Khataman</label>
                            <input type="date" name="tanggal" class="form-control">

                            @if($errors->has('tanggal'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('tanggal') }}</strong>
                            </span>
                            @endif

                        </div>

                        <div class="form-group">

                            <label>Tanggal Khataman</label>
                            <input type="date" name="tanggal" class="form-control">

                            @if($errors->has('tanggal'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('tanggal') }}</strong>
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