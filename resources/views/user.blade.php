@extends('master')

@section('konten')

<?php

use Illuminate\Support\Facades\Auth;

$fileName = Route::current()->getName();
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
                    @if($errors->has('password'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <button type="button" class="btn btn-success btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                                        Tambah {{$fileName}} </button>
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th width="1%">No</th>
                                                            <th>Nama</th>
                                                            <th>USER</th>
                                                            <th>Role</th>
                                                            <th>option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $no = 1;
                                                        @endphp
                                                        @foreach($user as $user)
                                                        <tr>
                                                            <td>{{$no++}}</td>
                                                            <td>{{$user->name}}</td>
                                                            <td>{{$user->email}}</td>
                                                            <td>
                                                                <?php
                                                                if ($user->role == 1) {
                                                                    echo "Admin";
                                                                }
                                                                if ($user->role == 2) {
                                                                    echo "Admin Bagian";
                                                                }
                                                                if ($user->role == 3) {
                                                                    echo "User";
                                                                }
                                                                if ($user->role == 4) {
                                                                    echo "Staff";
                                                                }
                                                                if ($user->role == 5) {
                                                                    echo "Satpam";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-xs btn-success edit_user" data-id="{{$user->id}}"><i class="fa fa-pencil"></i></button>

                                                                <a href="{{ url('/user/hapus/'.$user->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="fa fa-trash"></i></a>

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
                        </div>
                    </div> <!-- End row -->
                </div>
            </div>

        </div>
    </div>
</div>


<!-- MODAL TAMBAH DATA -->
<!-- MODAL TAMBAH DATA -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>

            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('simpan_user')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Divisi</label>
                        <div>
                            <!-- <input type="text" name="name" placeholder="Divisi" class="form-control" required> -->
                            <select name="name" class="form-control" required>
                                <option value="">- Pilih Divisi</option>
                                <option value="TI">TI</option>
                                <option value="SDM">SDM</option>
                                <option value="DISTRIBUSI">DISTRIBUSI</option>
                                <option value="KEUANGAN">KEUANGAN</option>
                                <option value="PEMASARAN">PEMASARAN</option>
                                <option value="PENGADAAN">PENGADAAN</option>
                                <option value="BPP">BPP</option>
                                <option value="PENGENDALIAN">PENGENDALIAN</option>
                                <option value="PERENCANAAN">PERENCANAAN</option>
                                <option value="PRODUKSI">PRODUKSI</option>
                                <option value="SATPAM">SATPAM</option>
                                <option value="SEKPER">SEKPER</option>
                                <option value="SPI">SPI</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="form-group"><label class="control-label">User</label>
                <div><input type="text" name="email" placeholder="Digunakan untuk Login" class="form-control" required>
                </div>
            </div>

            <div class="form-group"><label class="control-label">Role</label>
                <div><select name="role" class="form-control">
                        <option value="">- Pilih Role</option>
                        <option value="1">Admin</option>
                        <option value="2">Admin Bagian</option>
                        <option value="3">User</option>
                        <option value="4">Staf</option>
                        <option value="5">Satpam</option>
                    </select>
                </div>
            </div>

            <div class="form-group"><label class="control-label">Password Tambah</label>
                <div><input type="password" name="password" class="form-control" required></div>
            </div>
            <div class="form-group"><label class="control-label">Confirm Password</label>
                <div><input type="password" name="password_confirmation" class="form-control" required></div>
            </div>

            <div class="form-group"><label class="control-label"></label>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
            </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END MODAL TAMBAH DATA -->
<!-- END MODAL TAMBAH DATA -->

<!-- MODAL UBAH DATA -->
<!-- MODAL UBAH DATA -->

<div id="modal_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Ubah DATA</h4>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('update_user')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Divisi</label>
                        <div>
                            <select name="name" id="name" class="form-control" required>
                                <option value="">- Pilih Divisi</option>
                                <option value="TI">TI</option>
                                <option value="SDM">SDM</option>
                                <option value="DISTRIBUSI">DISTRIBUSI</option>
                                <option value="KEUANGAN">KEUANGAN</option>
                                <option value="PEMASARAN">PEMASARAN</option>
                                <option value="PENGADAAN">PENGADAAN</option>
                                <option value="BPP">BPP</option>
                                <option value="PENGENDALIAN">PENGENDALIAN</option>
                                <option value="PERENCANAAN">PERENCANAAN</option>
                                <option value="PRODUKSI">PRODUKSI</option>
                                <option value="SATPAM">SATPAM</option>
                                <option value="SEKPER">SEKPER</option>
                                <option value="SPI">SPI</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">User</label>
                        <div><input type="text" name="email" id="email" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Role</label>
                        <div><select name="role" id="role" class="form-control">
                                <option value="">- Pilih Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Manajer</option>
                                <option value="3">SPV</option>
                                <option value="4">Staf</option>
                                <option value="5">Satpam</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                    </div>

                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group"><label class="control-label"></label>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Ubah</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- END MODAL UBAH DATA -->
<!-- END MODAL UBAH DATA -->


<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
    $(document).ready(function() {
        //edit data
        $('body').on('click', '.edit_user', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('edit_user')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id').val(data.id);
                    // $('#jenisKendaraan').val(data.jenisKendaraan);

                    $('#name option[value="' + data.name + '"]').prop('selected', true);
                    $('#email').val(data.email);
                    $('#role option[value="' + data.role + '"]').prop('selected', true);

                    $('#modal_edit').modal('show');
                }

            });
        });

    });
</script>
@endsection