@extends('master')

@section('konten')

<?php

use Illuminate\Support\Facades\Auth;

$roleadmin = Auth::user()->role;

?>
@foreach($kendaraan_coba as $kendaraan_coba)
<?php


$param = array(60, 61, 62, 63, 120, 121, 122, 123, 180, 181, 182, 183, 240, 241, 242, 243, 300, 301, 302, 303, 360, 361, 362, 363, 420, 421, 422, 423, 480, 481, 482, 483);

$fdate = $kendaraan_coba->last_servis_date; //21 Agustus 2022
$tdate = date("Y-m-d H:i:s");
$datetime1 = new DateTime($fdate);
$datetime2 = new DateTime($tdate);
$interval = $datetime1->diff($datetime2);
$days = $interval->format('%a');

if (in_array($days, $param)) { ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        Kendaraan <b>{{$kendaraan_coba->noPolisi}} - {{$kendaraan_coba->merek}}</b> Sudah Memasuki jadwal Servis
    </div>
<?php }
?>
@endforeach
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
                                    <h3 class="panel-title">Data Kendaraan</h3>
                                    <?php
                                    if ($roleadmin == 1) { ?>
                                        <button type="button" class="btn btn-success btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                                            Tambah</button>
                                    <?php } else {
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs navtab-bg">
                                <li class="">
                                    <a href="#home" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Roda Dua</span>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="#profile" data-toggle="tab" aria-expanded="true">
                                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                                        <span class="hidden-xs">Roda Empat</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane" id="home">
                                    <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%">No</th>
                                                    <th>Jenis Kendaraan</th>
                                                    <!-- <th>Nomor STNK</th> -->
                                                    <th>Nomor Polisi</th>
                                                    <!-- <th>Nomor Mesin</th>
                                                            <th>Nomor Rangka</th> -->
                                                    <th>Merek</th>
                                                    <th>Warna</th>
                                                    <th>Servis (Km)</th>
                                                    <th>Servis (Bulan)</th>
                                                    <th>Status</th>
                                                    <th>Divisi</th>
                                                    <th>option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $no = 1;
                                                @endphp
                                                @foreach($kendaraan as $kendaraan)
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$kendaraan->jenisKendaraan}}</td>
                                                    <!-- <td>{{$kendaraan->noSTNK}}</td> -->
                                                    <td>{{$kendaraan->noPolisi}}</td>
                                                    <!-- <td>{{$kendaraan->noMesin}}</td>
                                                            <td>{{$kendaraan->noRangka}}</td> -->
                                                    <td>{{$kendaraan->merek}}</td>
                                                    <td>{{$kendaraan->warna}}</td>
                                                    <td>{{$kendaraan->last_servis}}</td>
                                                    <td><?php
                                                        if ($kendaraan->last_servis_date === null) {
                                                            echo "-";
                                                        } else {
                                                            echo date('d M Y', strtotime($kendaraan->last_servis_date));
                                                        } ?></td>
                                                    <td><?php
                                                        if ($kendaraan->status == 1) {
                                                            echo "Tersedia";
                                                        } else if ($kendaraan->status == 2) {
                                                            echo "Tidak Tersedia";
                                                        } else if ($kendaraan->status == 4) {
                                                            echo "Sedang dalam perawatan";
                                                        } else {
                                                            echo "Digunakan Di Wilayah";
                                                        }
                                                        ?></td>
                                                    <td>{{$kendaraan->divisi}}</td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($roleadmin == 1) { ?>
                                                            <button type="button" class="btn btn-xs btn-warning edit_last_servis" data-id="{{$kendaraan->id}}"><i class="fa fa-plus"></i></button>

                                                            <button type="button" class="btn btn-xs btn-success edit_kendaraan" data-id="{{$kendaraan->id}}"><i class="fa fa-pencil"></i></button>

                                                            <a href="{{ url('/kendaraan/hapus/'.$kendaraan->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="fa fa-trash"></i></a>

                                                            <button type="button" class="btn btn-xs btn-primary edit_ketersediaan" data-id="{{$kendaraan->id}}"><i class="fa fa-car"></i></button>
                                                        <?php } else {
                                                        }
                                                        ?>

                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane active" id="profile">
                                    <div class="table-responsive">
                                        <table id="datatable-buttons1" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%">No</th>
                                                    <th>Jenis Kendaraan</th>
                                                    <!-- <th>Nomor STNK</th> -->
                                                    <th>Nomor Polisi</th>
                                                    <!-- <th>Nomor Mesin</th>
                                                            <th>Nomor Rangka</th> -->
                                                    <th>Merek</th>
                                                    <th>Warna</th>
                                                    <th>Servis (Km)</th>
                                                    <th>Servis (Bulan)</th>
                                                    <th>Status</th>
                                                    <th>Divisi</th>
                                                    <th>option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $no = 1;
                                                @endphp
                                                @foreach($kendaraanEmpat as $kendaraan)
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$kendaraan->jenisKendaraan}}</td>
                                                    <!-- <td>{{$kendaraan->noSTNK}}</td> -->
                                                    <td>{{$kendaraan->noPolisi}}</td>
                                                    <!-- <td>{{$kendaraan->noMesin}}</td>
                                                            <td>{{$kendaraan->noRangka}}</td> -->
                                                    <td>{{$kendaraan->merek}}</td>
                                                    <td>{{$kendaraan->warna}}</td>
                                                    <td>{{$kendaraan->last_servis}}</td>
                                                    <td><?php
                                                        if ($kendaraan->last_servis_date === null) {
                                                            echo "-";
                                                        } else {
                                                            echo date('d M Y', strtotime($kendaraan->last_servis_date));
                                                        } ?></td>
                                                    <td><?php
                                                        if ($kendaraan->status == 1) {
                                                            echo "Tersedia";
                                                        } else if ($kendaraan->status == 2) {
                                                            echo "Tidak Tersedia";
                                                        } else if ($kendaraan->status == 4) {
                                                            echo "Sedang dalam perawatan";
                                                        } else {
                                                            echo "Digunakan Di Wilayah";
                                                        }
                                                        ?></td>
                                                    <td>{{$kendaraan->divisi}}</td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($roleadmin == 1) { ?>
                                                            <button type="button" class="btn btn-xs btn-warning edit_last_servis" data-id="{{$kendaraan->id}}"><i class="fa fa-plus"></i></button>

                                                            <button type="button" class="btn btn-xs btn-success edit_kendaraan" data-id="{{$kendaraan->id}}"><i class="fa fa-pencil"></i></button>

                                                            <a href="{{ url('/kendaraan/hapus/'.$kendaraan->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="fa fa-trash"></i></a>

                                                            <button type="button" class="btn btn-xs btn-primary edit_ketersediaan" data-id="{{$kendaraan->id}}"><i class="fa fa-car"></i></button>
                                                        <?php } else {
                                                        }
                                                        ?>

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
                <form name="frm_add" id="frm_add" action="{{route('simpan_kendaraan')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Jenis Kendaraan</label>
                        <div>
                            <select name="jenisKendaraan" id="jenisKendaraan" class="form-control">
                                <option value="">- Pilih Kendaraan</option>
                                <option value="roda dua">Roda Dua</option>
                                <option value="roda empat">Roda Empat</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor STNK</label>
                        <div><input type="text" name="noSTNK" placeholder="Nomor STNK" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor Polisi</label>
                        <div><input type="text" name="noPolisi" placeholder="Nomor Polisi" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor Mesin</label>
                        <div><input type="text" name="noMesin" placeholder="Nomor Mesin" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor Rangka</label>
                        <div><input type="text" name="noRangka" placeholder="Nomor Rangka" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Merek</label>
                        <div><input type="text" name="merek" placeholder="Merek" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Warna</label>
                        <div><input type="text" name="warna" placeholder="warna" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Divisi</label>
                        <div><select name="divisi" class="form-control">
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
                            </select></div>
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
                <form name="frm_add" id="frm_add" action="{{route('update_kendaraan')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Nomor STNK</label>
                        <div><input type="text" name="noSTNK" id="noSTNK" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Jenis Kendaraan</label>
                        <div><select name="jenisKendaraan" id="jenisKendaraan" class="form-control">
                                <option value="">- Pilih Kendaraan</option>
                                <option value="roda dua">Roda Dua</option>
                                <option value="roda empat">Roda Empat</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor Polisi</label>
                        <div><input type="text" name="noPolisi" id="noPolisi" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor Mesin</label>
                        <div><input type="text" name="noMesin" id="noMesin" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor Rangka</label>
                        <div><input type="text" name="noRangka" id="noRangka" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Merek</label>
                        <div><input type="text" name="merek" id="merek" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Warna</label>
                        <div><input type="text" name="warna" id="warna" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Divisi</label>
                        <div><select name="divisi" id="divisi" class="form-control">
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
                            </select></div>
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

<!-- MODAL TAMBAH LAST SERVIS -->
<!-- MODAL TAMBAH LAST SERVIS -->

<div id="modal_edit_lastservis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Km Terakhir Servis</h4>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('update_last_servis')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Km Terakhir Servis</label>
                        <div>
                            <input type="number" name="last_servis" id="last_servis" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Bulan Terakhir Servis</label>
                        <div>
                            <input type="date" name="last_servis_date" id="last_servis_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>

                    <input type="hidden" name="id_last_servis" id="id_last_servis" value="">
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
<!-- END MODAL LAST SERVIS -->
<!-- END MODAL LAST SERVIS -->

<!-- MODAL KETERSEDIAAN -->
<!-- MODAL KETERSEDIAAN -->

<div id="modal_edit_ketersediaan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Ketersediaan Kendaraan</h4>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('update_ketersediaan')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Ketersediaan</label>
                        <div>
                            <select name="status" id="" class="form-control">
                                <option value="">- Pilih</option>
                                <option value="1">Tersedia</option>
                                <!-- <option value="2">Tidak Tersedia</option> -->
                                <option value="4">Sedang dalam perawatan</option>
                                <option value="6">Digunakan Di Wilayah</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>

                    <input type="hidden" name="id_ketersediaan" id="id_ketersediaan" value="">
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
<!-- END MODAL KETERSEDIAAN -->
<!-- END MODAL KETERSEDIAAN -->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
    $(document).ready(function() {
        //edit data
        $('body').on('click', '.edit_kendaraan', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('edit_kendaraan')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id').val(data.id);
                    // $('#jenisKendaraan').val(data.jenisKendaraan);
                    $('#jenisKendaraan option[value="' + data.jenisKendaraan + '"]').prop('selected', true);
                    $('#noSTNK').val(data.noSTNK);
                    $('#noPolisi').val(data.noPolisi);
                    $('#noMesin').val(data.noMesin);
                    $('#noRangka').val(data.noRangka);
                    $('#merek').val(data.merek);
                    $('#warna').val(data.warna);
                    $('#divisi option[value="' + data.divisi + '"]').prop('selected', true);
                    $('#modal_edit').modal('show');
                }

            });
        });

        $('body').on('click', '.edit_last_servis', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('edit_last_servis')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id_last_servis').val(data.id);
                    $('#last_servis').val(data.last_servis);
                    $('#modal_edit_lastservis').modal('show');
                }

            });
        });

        $('body').on('click', '.edit_ketersediaan', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('edit_ketersediaan')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id_ketersediaan').val(data.id);
                    $('#modal_edit_ketersediaan').modal('show');
                }

            });
        });

    });
</script>

@endsection