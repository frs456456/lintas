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
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Filter Laporan Peminjaman</h3>
                                    </div>
                                    <?php
                                    ?>
                                    <form method="get" action="{{ url('/laporanhasil') }}">
                                        @csrf
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Dari Tanggal</label>
                                                            @if(empty($dari))
                                                            <input type="date" name="dari" class="form-control" value="">
                                                            @else
                                                            <input type="date" name="dari" class="form-control" value="{{$dari}}">
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Sampai Tanggal</label>
                                                            @if(empty($sampai))
                                                            <input type="date" name="sampai" class="form-control" value="">
                                                            @else
                                                            <input type="date" name="sampai" class="form-control" value="{{$sampai}}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="submit" class="btn btn-primary" value="Tampilkan">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Data Kendaraan</h3>
                                    </div>

                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="table-responsive">
                                                    <table id="datatable-buttons" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th width="1%">No</th>
                                                                <th>Pemohon</th>
                                                                <th>Tanggal</th>
                                                                <th>Nomor Formulir</th>
                                                                <th>Bagian</th>
                                                                <th>Pengemudi</th>
                                                                <th>Durasi</th>
                                                                <th>Keperluan</th>
                                                                <th>Keadaan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $no = 1;
                                                            @endphp
                                                            @isset($laporan)
                                                            @foreach($laporan as $l)
                                                            <tr>
                                                                <td>{{$no++}}</td>
                                                                <td>{{$l->pegawai->nama}}</td>
                                                                <td>{{$l->tanggal}}</td>
                                                                <td>{{$l->noForm}}</td>

                                                                <td>{{$l->pegawai->divisi}}</td>
                                                                <td>{{$l->namaSupir}}</td>
                                                                <td>{{$l->lamaPinjam}} Hari</td>
                                                                <td>{{$l->keperluan}}</td>
                                                                <td>{{$l->keluhan}}</td>
                                                            </tr>
                                                            @endforeach
                                                            @endisset

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
                        <div><input type="number" name="last_servis" id="last_servis" class="form-control" required></div>
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