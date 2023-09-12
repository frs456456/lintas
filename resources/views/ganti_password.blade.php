@extends('master')

@section('konten')

<?php

use Illuminate\Support\Facades\Auth;

$roleadmin = Auth::user()->role;
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                </div>

                <div class="card-body">

                    @if(Session::has('sukses'))
                    <div class="alert alert-success">
                        {{ Session::get('sukses') }}
                    </div>
                    @endif


                    <div class="row">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Ubah Password</h3>

                                </div>

                                <div class="panel-body">
                                    @if($errors->has('password'))
                                   
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>

                                
                                    @endif
                                    <div class="row">
                                        <form name="frm_add" id="frm_add" action="{{route('update_gpass')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group"><label class="control-label">Password
                                                    Tambah</label>
                                                <div><input type="password" name="password" class="form-control" required></div>
                                            </div>
                                            <div class="form-group"><label class="control-label">Confirm
                                                    Password</label>
                                                <div><input type="password" name="password_confirmation" class="form-control" required></div>
                                            </div>
                                            <div class="form-group"><label class="control-label"></label>
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div> <!-- End row -->
                </div>
            </div>

        </div>
    </div>
</div>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
    $(document).ready(function() {
        //edit data
        $('body').on('click', '.edit_pegawai', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('edit_pegawai')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#nip').val(data.nip);
                    $('#nama').val(data.nama);
                    $('#divisi').val(data.divisi);
                    $('#bagian').val(data.bagian);
                    $('#jabatan').val(data.jabatan);
                    $('#modal_edit').modal('show');
                }

            });
        });

    });
</script>
@endsection