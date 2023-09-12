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
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Data Pegawai</h3>
                                    <button type="button" class="btn btn-success btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                                        Tambah</button>
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="1%">No</th>
                                                            <th>NIPP</th>
                                                            <th>Nama</th>
                                                            <th>Bagian</th>
                                                            <th>Unit Kerja</th>
                                                            <th>Jabatan</th>
                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $no = 1;
                                                        @endphp
                                                        @foreach($pegawai as $pegawai)
                                                        <tr>
                                                            <td>{{$no++}}</td>
                                                            <td>{{$pegawai->nip}}</td>
                                                            <td>{{$pegawai->nama}}</td>
                                                            <td>{{$pegawai->divisi}}</td>
                                                            <td>{{$pegawai->bagian}}</td>
                                                            <td>{{$pegawai->jabatan}}</td>

                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-xs btn-success edit_pegawai" data-id="{{$pegawai->id}}"><i class="fa fa-pencil"></i></button>

                                                                <a href="{{ url('/pegawai/hapus/'.$pegawai->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="fa fa-trash"></i></a>

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
                <form name="frm_add" id="frm_add" action="{{route('simpan_pegawai')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">NIP</label>
                        <div><input type="text" name="nip" placeholder="NIP" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Nama</label>
                        <div><input type="text" name="nama" placeholder="Nama Pegawai" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Bagian</label>
                        <div><input type="text" name="divisi" placeholder="Bagian" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Unit Kerja</label>
                        <div><input type="text" name="bagian" placeholder="Unit Kerja" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Jabatan</label>
                        <div><input type="text" name="jabatan" placeholder="Jabatan" class="form-control" required></div>
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
                <form name="frm_add" id="frm_add" action="{{route('update_pegawai')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">NIP</label>
                        <div><input type="text" name="nip" id="nip" placeholder="Merek HP" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Nama</label>
                        <div><input type="text" name="nama" id="nama" placeholder="Merek HP" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Bagian</label>
                        <div><input type="text" name="divisi" id="divisi" placeholder="Tipe" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Unit Kerja</label>
                        <div><input type="text" name="bagian" id="bagian" value="" placeholder="Warna" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Jabatan</label>
                        <div><input type="text" name="jabatan" id="jabatan" value="" placeholder="IMEI 1" class="form-control" required></div>
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