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
                                    <h3 class="panel-title">Data Inventaris HP</h3>
                                    <button type="button" class="btn btn-success btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                                        Tambah</button>
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="1%">No</th>
                                                            <th>Merk</th>
                                                            <th>Tipe</th>
                                                            <th>Warna</th>
                                                            <th>IMEI 1</th>
                                                            <th>IMEI 2</th>
                                                            <th>Serial Number</th>
                                                            <th>Kode Inventaris</th>
                                                            <th>Nomor HP</th>
                                                            <th>Status</th>
                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $no = 1;
                                                        @endphp
                                                        @foreach($handphone as $handphone)
                                                        <tr>
                                                            <td>{{$no++}}</td>
                                                            <td>{{$handphone->merk}}</td>
                                                            <td>{{$handphone->tipe}}</td>
                                                            <td>{{$handphone->warna}}</td>
                                                            <td>{{$handphone->imei1}}</td>
                                                            <td>{{$handphone->imei2}}</td>
                                                            <td>{{$handphone->serial_number}}</td>
                                                            <td>{{$handphone->kode_inventaris}}</td>
                                                            <td>{{$handphone->no_hp}}</td>
                                                            <td> <?php if ($handphone->status == 1) { ?>
                                                                    Belum Digunakan
                                                                <?php } else { ?> Sudah Digunakan </td>
                                                        <?php  } ?>

                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-xs btn-success edit_handphone" data-id="{{$handphone->id}}"><i class="fa fa-pencil"></i></button>

                                                            <a href="{{ url('/handphone/hapus/'.$handphone->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="fa fa-trash"></i></a>


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
                <form name="frm_add" id="frm_add" action="{{route('simpan_handphone')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Merk HP</label>
                        <div><input type="text" name="merk" placeholder="Merek HP" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Tipe</label>
                        <div><input type="text" name="tipe" placeholder="Tipe" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Warna</label>
                        <div><input type="text" name="warna" placeholder="Warna" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">IMEI 1</label>
                        <div><input type="text" name="imei1" placeholder="IMEI 1" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">IMEI 2</label>
                        <div><input type="text" name="imei2" placeholder="IMEI 2" class="form-control" required></div>
                    </div>

                    <div class="form-group"><label class="control-label">Serial Number</label>
                        <div><input type="text" name="serial_number" placeholder="Serial Number" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Kode Inventaris</label>
                        <div><input type="text" name="kode_inventaris" placeholder="Kode Inventaris" class="form-control"></div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor HP</label>
                        <div><input type="number" name="no_hp" placeholder="Nomor Handphone" class="form-control"></div>
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
                <form name="frm_add" id="frm_add" action="{{route('update_handphone')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Merk HP</label>
                        <div><input type="text" name="merk" id="merk" value="{{$handphone->merk}}" placeholder="Merek HP" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Tipe</label>
                        <div><input type="text" name="tipe" id="tipe" value="{{$handphone->tipe}}" placeholder="Tipe" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Warna</label>
                        <div><input type="text" name="warna" id="warna" value="{{$handphone->warna}}" placeholder="Warna" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">IMEI 1</label>
                        <div><input type="text" name="imei1" id="imei1" value="{{$handphone->imei1}}" placeholder="IMEI 1" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">IMEI 2</label>
                        <div><input type="text" name="imei2" id="imei2" value="{{$handphone->imei2}}" placeholder="IMEI 2" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Serial Number</label>
                        <div><input type="text" name="serial_number" id="serial_number" value="{{$handphone->serial_number}}" placeholder="Serial Number" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Kode Inventaris</label>
                        <div><input type="text" name="kode_inventaris" id="kode_inventaris" value="{{$handphone->kode_inventaris}}" placeholder="Kode Inventaris" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor HP</label>
                        <div><input type="text" name="no_hp" id="no_hp" value="{{$handphone->no_hp}}" placeholder="Nomor HP" class="form-control" required></div>
                    </div>
                    <div class="modal-footer">
                    </div>

                    <input type="hidden" name="id" id="id" value="{{$handphone->id}}">
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
        $('body').on('click', '.edit_handphone', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('edit_handphone')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#merk').val(data.merk);
                    $('#tipe').val(data.tipe);
                    $('#warna').val(data.warna);
                    $('#imei1').val(data.imei1);
                    $('#imei2').val(data.imei2);
                    $('#serial_number').val(data.serial_number);
                    $('#kode_inventaris').val(data.kode_inventaris);
                    $('#no_hp').val(data.no_hp);
                    $('#modal_edit').modal('show');
                }

            });
        });

    });
</script>
@endsection