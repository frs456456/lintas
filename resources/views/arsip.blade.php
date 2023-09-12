@extends('master')

@section('konten')
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

$roleadmin = Auth::user()->role;
$fileName = Route::current()->getName();

use App\Models\Arsip;
use App\Models\Kategori;
use App\Models\User;

?>
<style>
    select[type="text"] {
        width: 200px;
        height: 20px;
        padding-right: 50px;
    }

    select[type="submit"] {
        margin-left: -50px;
        height: 20px;
        width: 50px;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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
                                    <h3 class="panel-title"></h3>
                                    <button type="button" class="btn btn-success btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                                        Tambah {{$fileName}}</button>
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <div>
                                                    <!-- <form name="frm_add" id="frm_add" action="cari{{$fileName}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <select class="form-control js-example-basic-multiple" name="carikat[]" multiple="multiple" style="width:90%" placeholder="Cari Arsip..">
                                                            <option value="" disabled selected>Cari Arsip... </option>
                                                            @foreach($selectkategori as $s)
                                                            <option value="{{$s->id}}">{{$s->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit" class="btn btn-md btn-warning waves-effect"><i class="fa fa-search"></i> Cari</button>
                                                    </form> -->

                                                    <form name="frm_add" id="frm_add" action="cari{{$fileName}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <select class="form-control" name="carikat" style="width:100%" placeholder="Cari Arsip..">
                                                            <option value="" disabled selected>Cari Arsip... </option>
                                                            @foreach($selectkategori as $s)
                                                            <option value="{{$s->id}}">{{$s->nama}}</option>
                                                            @endforeach
                                                        </select>

                                                        <button type="submit" class="btn btn-md btn-default waves-effect"><i class="fa fa-search"></i> Cari</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="1%">No</th>
                                                            <th>Waktu Upload</th>
                                                            <th>Arsip</th>
                                                            <th>Kategori</th>
                                                            <th>Petugas</th>
                                                            <th>Keterangan</th>
                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $no = 1;
                                                        @endphp
                                                        @foreach($$fileName as $f)
                                                        <tr>
                                                            <td>{{$no++}}</td>
                                                            <td><?php echo date('d M Y H:i:s', strtotime($f->waktuUpload));  ?></td>
                                                            <td>
                                                                <b>No : </b>{{$f->noArsip}} </br>
                                                                <b>Nama : </b>{{$f->nama}}</br>
                                                                <b>Jenis File : </b>{{$f->jenisFile}}</br>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $ex = explode(',', $f->id_kategori);

                                                                foreach ($ex as $ex) {

                                                                    $kat = Kategori::select("*")
                                                                        ->where('id', $ex)
                                                                        ->value('nama');
                                                                    // dd($ex);
                                                                ?>
                                                                    <button type="button" class="btn btn-xs btn-default"><?php echo $kat; ?></button>
                                                                <?php
                                                                }
                                                                ?>
                                                                <!-- {{$f->kategori->nama}} -->
                                                            </td>
                                                            <td>{{$f->user->name}}</td>
                                                            <td>{{$f->keterangan}}</td>

                                                            <td class="text-center">
                                                                <!-- <button type="button" class="btn btn-xs btn-success edit{{$fileName}}" data-id="{{$f->id}}"><i class="fa fa-pencil"></i></button>


                                                                <button type="button" data-id="{{$f->id}}" class="btn btn-xs btn-danger sa-params" id="sa-params"><i class="fa fa-trash"></i></button> -->

                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-xs btn-success waves-effect"><i class="fa fa-download"></i></button>
                                                                    <button type="button" class="btn btn-xs waves-effect"><i class="fa fa-search"></i> Preview</button>
                                                                    <button type="button" class="btn btn-xs btn-warning waves-effect"><i class="fa fa-pencil"></i></button>
                                                                </div>


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
                    </div>
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
                <h4 class="modal-title" id="myModalLabel">Tambah Data {{$fileName}}</h4>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="simpan{{$fileName}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Nomor Arsip</label>
                        <div><input type="text" name="noArsip" id="" placeholder="Nomor Arsip" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Nama</label>
                        <div>
                            <input type="text" name="nama" placeholder="Nama" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Kategori</label>
                        <div>
                            <!-- <select name="kategori" id="" class="form-control">
                                <option value="">- Pilih Kategori</option>
                                @foreach($selectkategori as $s)
                                <option value=" {{$s->id}}">{{$s->nama}}</option>
                                @endforeach
                            </select> -->
                            <select class="form-control js-example-basic-multiple" name="kategori[]" multiple="multiple" style="width:100%">
                                <option value="">- Pilih Kategori</option>
                                @foreach($selectkategori as $s)
                                <option value=" {{$s->id}}">{{$s->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Keterangan</label>
                        <div>
                            <textarea name="keterangan" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Upload File</label>
                        <div>
                            <input type="file" name="fileupload" placeholder="Nama" class="form-control" required>
                        </div>
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
<!-- END MODAL TAMBAH DATA -->
<!-- END MODAL TAMBAH DATA -->

<!-- MODAL UBAH DATA -->
<!-- MODAL UBAH DATA -->

<div id="modal_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Ubah Data {{$fileName}}</h4>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="update{{$fileName}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group"><label class="control-label">Nama</label>
                        <div><input type="text" name="nama" id="nama" placeholder="Merek HP" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Keterangan</label>
                        <div><input type="text" name="keterangan" id="keterangan" placeholder="Tipe" class="form-control" required>
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
        $('.js-example-basic-multiple').select2();
        //edit data
        $('body').on('click', '.edit{{$fileName}}', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "edit{{$fileName}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#keterangan').val(data.keterangan);
                    $('#modal_edit').modal('show');
                }

            });
        });

        $('body').on("click", '.sa-params', function() {
            var idhapus = $(this).attr('data-id');
            swal({
                title: "Apakah anda yakin?",
                text: "Data yang sudah di hapus tidak dapat dikembalikan!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel !",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    location.href = 'hapus{{$fileName}}/' + idhapus;
                    swal("Deleted!", "Data berhasil dihapus.", "success");
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
        });


    });
</script>
@endsection