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
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-white">CEK IMEI</h3>

                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <form name="myForm2">
                                                    <label class="control-label">Imei Lama</label><br />
                                                    <select name="fname2" id="fname2" class="theSelect" onchange="yesnoCheck(this);" required>
                                                        <option value="">- Pilih Pegawai</option>
                                                        @foreach($inventaris as $p)
                                                        <option value="{{$p->imei}}">{{$p->nama}} || {{$p->imei}}</option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                                </br>
                                                <div id="ifYes" style="display: none;">
                                                    <form name="myForm">
                                                        <label class="control-label">Cek Imei</label>
                                                        <input class="form-control" type="text" name="fname">
                                                        </br>
                                                        <button onclick="validateForm()" class="btn btn-success btn-primary waves-effect waves-light"><i class="fa fa-check"></i>
                                                            Cek</button>
                                                    </form>
                                                </div>

                                                <link rel="stylesheet" href="">
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
                                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
                                                <script>
                                                    $(".theSelect").select2();

                                                    function yesnoCheck(that) {
                                                        if (that.value != "") {

                                                            document.getElementById("ifYes").style.display = "block";
                                                        } else {
                                                            document.getElementById("ifYes").style.display = "none";
                                                        }
                                                    }

                                                    function validateForm() {
                                                        let x2 = document.forms["myForm2"]["fname2"].value;
                                                        let x = document.forms["myForm"]["fname"].value;
                                                        if (x !== x2) {
                                                            alert("Imei Tidak Sesuai");
                                                            return false;
                                                        } else {
                                                            alert("Imei Sudah Sesuai");
                                                        }
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End row -->


                </div>
                </br>

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

                                    <a href="{{ url('/inventaris/export_excel/') }}" class="btn btn-warning">Export Excel</a>


                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="1%">No</th>
                                                            <th>Nama Pegawai</th>
                                                            <th>Nomor HP</th>
                                                            <th>Jabatan</th>
                                                            <th>Area</th>
                                                            <th>Warna</th>
                                                            <th>Imei</th>
                                                            <th>Serial Number</th>
                                                            <th>Kode Inventaris</th>
                                                            <th>Wilayah</th>
                                                            <th>Imei Baru</th>
                                                            <th>Keterangan</th>
                                                            <th>Tanggal Maintenance</th>
                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $no = 1;
                                                        @endphp
                                                        @foreach($inventaris as $inventaris)
                                                        <tr>
                                                            <td>{{$no++}}</td>
                                                            <td>{{$inventaris->nama}}</td>
                                                            <td>{{$inventaris->no_hp}}</td>
                                                            <td>{{$inventaris->jabatan}}</td>
                                                            <td>{{$inventaris->area}}</td>
                                                            <td>{{$inventaris->warna}}</td>
                                                            <td>{{$inventaris->imei}}</td>
                                                            <td>{{$inventaris->serial_number}}</td>
                                                            <td>{{$inventaris->kd_inventaris}}</td>
                                                            <td>{{$inventaris->wilayah}}</td>
                                                            <td>{{$inventaris->imei_baru}}</td>
                                                            <td>{{$inventaris->keterangan}}</td>
                                                            <td>{{$inventaris->tgl_maintenance}}</td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-xs btn-success edit_inventaris" data-id="{{$inventaris->id}}"><i class="fa fa-pencil"></i></button>

                                                                <a href="{{ url('/inventaris/hapus/'.$inventaris->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="fa fa-trash"></i></a>


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
                <form name="frm_add" id="frm_add" action="{{route('simpan_inventaris')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Nama Pegawai</label>
                        <div><input type="text" name="nama" placeholder="Nama" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor HP</label>
                        <div><input type="number" name="no_hp" placeholder="Nomor HP" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Jabatan</label>
                        <div><input type="text" name="jabatan" placeholder="Jabatan" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Area</label>
                        <div><input type="text" name="area" placeholder="Area" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Warna</label>
                        <div><input type="text" name="warna" placeholder="Warna" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">IMEI</label>
                        <div><input type="text" name="imei" placeholder="IMEI" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Serial Number</label>
                        <div><input type="text" name="serial_number" placeholder="Serial Number" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Kode Inventaris</label>
                        <div><input type="text" name="kd_inventaris" placeholder="Kode Inventaris" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Wilayah</label>
                        <div>
                            <select class="form-control" name="wilayah" id="wilayah">
                                <option value="">- Pilih Wilayah</option>
                                <option value="barat">Barat</option>
                                <option value="timur">Timur</option>
                            </select>
                        </div>
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
                <form name="frm_add" id="frm_add" action="{{route('update_inventaris')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Nama Pegawai</label>
                        <div><input type="text" name="nama" placeholder="Nama" class="form-control" id="nama" value="{{$inventaris->nama}}" required></div>
                    </div>

                    <div class="form-group"><label class="control-label">Nomor HP</label>
                        <div><input type="number" name="no_hp" placeholder="Nomor HP" class="form-control" id="no_hp" value="{{$inventaris->no_hp}}" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Jabatan</label>
                        <div><input type="text" name="jabatan" placeholder="Jabatan" class="form-control" id="jabatan" value="{{$inventaris->jabatan}}" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Area</label>
                        <div><input type="text" name="area" placeholder="Area" class="form-control" id="area" value="{{$inventaris->area}}" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Warna</label>
                        <div><input type="text" name="warna" placeholder="Warna" class="form-control" id="warna" value="{{$inventaris->warna}}" required></div>
                    </div>

                    <div class="form-group"><label class="control-label">Serial Number</label>
                        <div><input type="text" name="serial_number" placeholder="Serial Number" class="form-control" value="{{$inventaris->serial_number}}" id="serial_number" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Kode Inventaris</label>
                        <div><input type="text" name="kd_inventaris" placeholder="Kode Inventaris" class="form-control" value="{{$inventaris->kd_inventaris}}" id="kd_inventaris" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Wilayah</label>
                        <div>
                            <select name="wilayah" id="wilayah" class="form-control" required>
                                <option value="">- Pilih Wilayah</option>
                                <option <?php if ($inventaris->wilayah == "barat") {
                                            echo "selected='selected'";
                                        } ?> value="barat">Barat</option>
                                <option <?php if ($inventaris->wilayah == "timur") {
                                            echo "selected='selected'";
                                        } ?> value="timur">Timur</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group"><label class="control-label">IMEI LAMA</label>
                            <div><input type="text" name="imei" placeholder="IMEI" class="form-control" id="imei" value="{{$inventaris->imei}}" required></div>
                        </div>
                        <div class="form-group"><label class="control-label">IMEI BARU</label>
                            <div><input type="text" name="imei_baru" placeholder="IMEI Baru" class="form-control" value="{{$inventaris->imei_baru}}" id="imei_baru"></div>
                        </div>
                        <div class="form-group"><label class="control-label">Keterangan</label>
                            <div><textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10" placeholder="Keterangan" value="{{$inventaris->keterangan}}">{{$inventaris->keterangan}}</textarea>
                            </div>
                        </div>


                        <input type="hidden" name="id" id="id" value="{{$inventaris->id}}">
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
        $('body').on('click', '.edit_inventaris', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('edit_inventaris')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#no_hp').val(data.no_hp);
                    $('#jabatan').val(data.jabatan);
                    $('#area').val(data.area);
                    $('#warna').val(data.warna);
                    $('#imei').val(data.imei);
                    $('#serial_number').val(data.serial_number);
                    $('#kd_inventaris').val(data.kd_inventaris);
                    $('#barat').val(data.barat);
                    $('#imei_baru').val(data.imei_baru);
                    $('#keterangan').val(data.keterangan);
                    $('#modal_edit').modal('show');
                }

            });
        });

    });
</script>
@endsection