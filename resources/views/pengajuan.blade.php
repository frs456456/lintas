@extends('master')

@section('konten')

<?php

use Illuminate\Support\Facades\Auth;

$roleadmin = Auth::user()->role;
$nama = Auth::user()->name;
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
                                    <h3 class="panel-title">Data Pengajuan Peminjaman</h3>
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th width="1%">No</th>
                                                            <th>Tanggal</th>
                                                            <th>Nomor Formulir</th>
                                                            <th>Pemohon</th>
                                                            <th>Bagian</th>
                                                            <th>Pengemudi</th>
                                                            <th>Durasi</th>
                                                            <th>Keterangan</th>
                                                            <th>Keperluan</th>
                                                            <th>Kendaraan</th>
                                                            <th>Status</th>

                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $no = 1;
                                                        @endphp
                                                        @foreach($pengajuan as $pengajuan)
                                                        <?php if ($pengajuan->status == 2 or $pengajuan->status == 1) { ?>
                                                            <tr style="background-color:bisque ;">
                                                                <td>{{$no++}}</td>
                                                                <td><?php echo date('d M Y', strtotime($pengajuan->tanggal)) ?>
                                                                </td>
                                                                <td>{{$pengajuan->noForm}}</td>
                                                                <td>{{$pengajuan->pegawai->nama}}</td>
                                                                <td>{{$pengajuan->pegawai->divisi}}</td>
                                                                <td>{{$pengajuan->namaSupir}}</td>
                                                                <td>{{$pengajuan->lamaPinjam}} Hari</td>
                                                                <td>{{$pengajuan->keluhan}}</td>
                                                                <td>{{$pengajuan->keperluan}}</td>
                                                                <td>{{$pengajuan->kendaraan->merek}}</td>
                                                                <td><?php if ($pengajuan->status == 1) { ?><button type="button" class="btn btn-default btn-xs waves-effect waves-light">Diajukan</button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 2) { ?>
                                                                        <button class="btn btn-default btn-xs waves-effect waves-light">Proses</button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 6) { ?>
                                                                        <button class="btn btn-default btn-xs waves-effect waves-light">Ditolak</button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 3) { ?>
                                                                        <button class="btn btn-default btn-xs waves-effect waves-light">Selesai</button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 4 and $pengajuan->disetujuiOleh == 1) { ?>
                                                                        <button class="btn btn-default btn-xs waves-effect waves-light">Verifikasi Atasan</button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 5) { ?>
                                                                        <button class="btn btn-default btn-xs waves-effect waves-light">Verifikasi Atasan</button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 6) { ?>
                                                                        <button class="btn btn-default btn-xs waves-effect waves-light">Ditolak</button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 4 and $pengajuan->disetujuiOleh == 2) { ?>
                                                                        <button class="btn btn-default btn-xs waves-effect waves-light">Booked</button>
                                                                    <?php }  ?>
                                                                </td>

                                                                <td class="text-center">

                                                                    <?php if ($pengajuan->status == 1 and $roleadmin == 1) { ?> <button type="button" class="btn btn-xs btn-warning edit_pengajuan" data-id="{{$pengajuan->id}}"><i class="ti-check-box"></i></button>
                                                                        <a class="btn btn-xs btn-danger tolak_pengajuan" data-id="{{$pengajuan->id}}"><i class="ti-close"></i></a>
                                                                    <?php }
                                                                    if ($pengajuan->status == 6) { ?> <button type="button" class="btn btn-xs btn-warning lihat_keterangan" data-id="{{$pengajuan->id}}"><i class="ti-eye"></i></button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 2 and is_null($pengajuan->kmAwal)) { ?>

                                                                    <?php }
                                                                    if ($pengajuan->status == 2 and !empty($pengajuan->kmAkhir)) { ?>
                                                                        <button type="button" class="btn btn-xs btn-success edit_terima" data-id="{{$pengajuan->id}}"><i class="ti-check-box"></i>Terima</button>
                                                                    <?php
                                                                    }
                                                                    if ($pengajuan->status == 3) { ?>
                                                                        <a href="{{ url('/detail_peminjaman'.$pengajuan->id) }}" class=" btn btn-xs btn-primary"><i class="ti-eye"></i> Detail</a>
                                                                    <?php }
                                                                    if ($pengajuan->status == 4 and $pengajuan->disetujuiOleh == 1) { ?> <a href="{{ url('/pengajuan/verif_spv_booking/'.$pengajuan->id) }}" class="btn btn-xs btn-warning" onclick="return confirm('Yakin akan terima ??')"><i class="ti-check-box"></i></a>

                                                                        <a href="{{ url('/pengajuan/hapusbooking/'.$pengajuan->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="ti-close"></i></a>
                                                                    <?php }
                                                                    if ($pengajuan->status == 4 and $pengajuan->disetujuiOleh == 2) { ?> <button type="button" class="btn btn-xs btn-warning edit_terimabooking" data-id="{{$pengajuan->id}}"><i class="ti-check-box"></i></button>

                                                                        <a href="{{ url('/pengajuan/hapusbooking/'.$pengajuan->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="ti-close"></i></a>
                                                                    <?php }
                                                                    if ($pengajuan->status == 5 and $pengajuan->pegawai->divisi == $nama) { ?> <a href="{{ url('/pengajuan/verif_spv/'.$pengajuan->id) }}" class="btn btn-xs btn-warning" onclick="return confirm('Yakin akan terima ??')"><i class="ti-check-box"></i></a>

                                                                        <a href="{{ url('/pengajuan/hapus/'.$pengajuan->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="ti-close"></i></a>
                                                                    <?php } ?>


                                                                </td>
                                                            </tr>
                                                        <?php } else { ?>
                                                            <tr>
                                                                <td>{{$no++}}</td>
                                                                <td><?php echo date('d M Y', strtotime($pengajuan->tanggal)) ?>
                                                                </td>
                                                                <td>{{$pengajuan->noForm}}</td>
                                                                <td>{{$pengajuan->pegawai->nama}}</td>
                                                                <td>{{$pengajuan->pegawai->divisi}}</td>
                                                                <td>{{$pengajuan->namaSupir}}</td>
                                                                <td>{{$pengajuan->lamaPinjam}} Hari</td>
                                                                <td>{{$pengajuan->keluhan}}</td>
                                                                <td>{{$pengajuan->keperluan}}</td>
                                                                <td>{{$pengajuan->kendaraan->merek}}</td>
                                                                <td><?php if ($pengajuan->status == 1) { ?><button type="button" class="btn btn-default btn-xs waves-effect waves-light">Diajukan</button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 2) { ?>
                                                                        <button class="btn btn-default btn-xs waves-effect waves-light">Proses</button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 3) { ?>
                                                                        <button class="btn btn-default btn-xs waves-effect waves-light">Selesai</button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 6) { ?>
                                                                        <button class="btn btn-default btn-xs waves-effect waves-light">Ditolak</button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 4 and $pengajuan->disetujuiOleh == 1) { ?>
                                                                        <button class="btn btn-default btn-xs waves-effect waves-light">Verifikasi Atasan</button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 5) { ?>
                                                                        <button class="btn btn-default btn-xs waves-effect waves-light">Verifikasi Atasan</button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 4 and $pengajuan->disetujuiOleh == 2) { ?>
                                                                        <button class="btn btn-default btn-xs waves-effect waves-light">Booked</button>
                                                                    <?php } ?>
                                                                </td>

                                                                <td class="text-center">

                                                                    <?php if ($pengajuan->status == 1 and $roleadmin == 1) { ?> <button type="button" class="btn btn-xs btn-warning edit_pengajuan" data-id="{{$pengajuan->id}}"><i class="ti-check"></i></button>

                                                                        <a href="{{ url('/pengajuan/hapus/'.$pengajuan->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="ti-close"></i></a>
                                                                    <?php }
                                                                    if ($pengajuan->status == 6) { ?> <button type="button" class="btn btn-xs btn-warning lihat_keterangan" data-id="{{$pengajuan->id}}"><i class="ti-eye"></i></button>
                                                                    <?php }
                                                                    if ($pengajuan->status == 2 and is_null($pengajuan->kmAwal)) { ?>

                                                                    <?php }
                                                                    if ($pengajuan->status == 2 and !empty($pengajuan->kmAwal)) { ?>
                                                                        <button type="button" class="btn btn-xs btn-success edit_terima" data-id="{{$pengajuan->id}}"><i class="ti-check-box"></i>Terima</button>
                                                                    <?php
                                                                    }
                                                                    if ($pengajuan->status == 3) { ?>
                                                                        <a href="{{ url('/detail_peminjaman'.$pengajuan->id) }}" class=" btn btn-xs btn-primary"><i class="ti-eye"></i> Detail</a>
                                                                    <?php }
                                                                    if ($pengajuan->status == 4 and $pengajuan->disetujuiOleh == 1 and $pengajuan->pegawai->divisi == $nama) { ?>
                                                                        <a href="{{ url('/pengajuan/verif_spv_booking/'.$pengajuan->id) }}" class="btn btn-xs btn-warning" onclick="return confirm('Yakin akan terima ??')"><i class="ti-check-box"></i></a>

                                                                        <a href="{{ url('/pengajuan/hapusbooking/'.$pengajuan->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="ti-close"></i></a>
                                                                    <?php }
                                                                    if ($pengajuan->status == 4 and $pengajuan->disetujuiOleh == 2 and $nama == "admin") { ?> <button type="button" class="btn btn-xs btn-warning edit_terimabooking" data-id="{{$pengajuan->id}}"><i class="ti-check-box"></i></button>

                                                                        <a href="{{ url('/pengajuan/hapusbooking/'.$pengajuan->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="ti-close"></i></a>
                                                                    <?php }
                                                                    if ($pengajuan->status == 5 and $pengajuan->pegawai->divisi == $nama) { ?> <a href="{{ url('/pengajuan/verif_spv/'.$pengajuan->id) }}" class="btn btn-xs btn-warning" onclick="return confirm('Yakin akan terima ??')"><i class="ti-check-box"></i></a>

                                                                        <a href="{{ url('/pengajuan/hapus/'.$pengajuan->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="ti-close"></i></a>
                                                                    <?php } ?>


                                                                </td>
                                                            </tr>
                                                        <?php
                                                        } ?>

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


<!-- MODAL UBAH DATA -->
<!-- MODAL UBAH DATA -->

<div id="modal_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Terima Pengajuan Peminjaman</h4>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('update_pengajuan')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Kendaraan</label>
                        <div><select name="id_kendaraan" id="id_kendaraan" class="form-control">
                                <option value="">- Pilih Kendaraan</option>
                                @foreach($kendaraan as $kendaraan)
                                <option value="{{ $kendaraan->id }}">{{ $kendaraan->noPolisi }} || {{$kendaraan->merek}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                    </div>

                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group"><label class="control-label"></label>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">SIMPAN</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL UBAH DATA -->
<!-- END MODAL UBAH DATA -->

<!-- MODAL EDIT TERIMA -->
<!-- MODAL EDIT TERIMA -->

<div id="modal_edit_terima" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Terima Kendaraan</h4>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('update_terima')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Tanggal Kembali</label>
                        <div><input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Catatan</label></div>
                    <div><textarea class="form-control" name="catatan_sekper" cols="30" rows="10" placeholder="Kosongkan apabila tidak ada"></textarea></div>
                    <center>
                        <div class="form-group">
                            <h4>Sebelum</h4></br>
                            <img id="bDepanBfr" class="img-rounded" width="150px">
                            <img id="bBelakangBfr" class="img-rounded" width="150px">
                            <img id="bKananBfr" class="img-rounded" width="150px">
                            <img id="bKiriBfr" class="img-rounded" width="150px">
                        </div>

                        <div class="form-group">
                            <h4>Sesudah</h4></br>
                            <img id="bDepan" class="img-rounded" width="150px">
                            <img id="bBelakang" class="img-rounded" width="150px">
                            <img id="bKanan" class="img-rounded" width="150px">
                            <img id="bKiri" class="img-rounded" width="150px">
                        </div>

                    </center>
                    <div class="modal-footer">
                    </div>

                    <input type="hidden" name="id_terima" id="id_terima" value="">
                    <div class="form-group"><label class="control-label"></label>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">SIMPAN</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- END MODAL EDIT TERIMA -->
<!-- END MODAL EDIT TERIMA -->

<!-- MODAL BOOKING TERIMA -->
<!-- MODAL BOOKING TERIMA -->

<div id="modal_edit_terimabooking" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Terima Booking</h4>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('update_terima_booking')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Tanggal Peminjaman</label>
                        <div><input type="date" name="tgl_peminjaman" id="tgl_peminjaman_booking" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor Formulir</label>
                        <div><input type="text" name="noForm" id="noForm_auto" placeholder="Nomor Formulir" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                    </div>

                    <input type="hidden" name="id_terima" id="id_terima_booking" value="">
                    <input type="hidden" name="id_terima_booking_kendaraan" id="id_terima_booking_kendaraan" value="">
                    <div class="form-group"><label class="control-label"></label>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">SIMPAN</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- END MODAL BOOKING TERIMA -->
<!-- END MODAL BOOKING TERIMA -->


<!-- MODAL TOLAK PENGAJUAN -->
<!-- MODAL TOLAK PENGAJUAN -->

<div id="modal_tolak_pengajuan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Tolak Pengajuan Peminjaman</h4>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('update_tolak_pengajuan')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Keterangan</label>
                        <div><textarea class="form-control" name="ket_Ditolak" cols="30" rows="10"></textarea>

                        </div>
                    </div>

                    <div class="modal-footer">
                    </div>

                    <input type="hidden" name="id_ket_Ditolak" id="id_ket_Ditolak">
                    <div class="form-group"><label class="control-label"></label>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">SIMPAN</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END MODAL TOLAK PENGAJUAN -->
<!-- END MODAL UBAH PENGAJUAN -->

<!-- MODAL LIHAT KETERANGAN -->
<!-- MODAL LIHAT KETERANGAN -->

<div id="modal_lihat_keterangan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('update_tolak_pengajuan')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Keterangan</label>
                        <div><textarea class="form-control" name="ket_Ditolak_lihat" id="ket_Ditolak_lihat" cols="30" rows="10" disabled></textarea>

                        </div>
                    </div>

                    <div class="modal-footer">
                    </div>
                    <div class="form-group"><label class="control-label"></label>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <!-- <button type="submit" class="btn btn-primary waves-effect waves-light">SIMPAN</button> -->
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END MODAL LIHAT KETERANGAN -->
<!-- END MODAL LIHAT KETERANGAN -->

<link rel="stylesheet" href="">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
    $("#id_pegawai").select2({
        width: '100%'
    });

    $(".id_pegawai").select2({
        width: '100%'
    });

    $("#id_pegawai").val();
    $('#noForm_auto').val('SEKPER/14.07.22/__');


    $("#id_pegawai option:selected").text();

    $("#id_kendaraan").select2({
        width: '100%'
    });
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
    $(document).ready(function() {
        //edit data
        $('body').on('click', '.edit_pengajuan', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('edit_pengajuan')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#id_kendaraan').val(data.id_kendaraan);
                    $('#modal_edit').modal('show');
                }
            });
        });

        $('body').on('click', '.edit_terima', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('edit_terima')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id_terima').val(data.id);
                    $('#bDepanBfr').prop('src', (data.bDepanBfr));
                    $('#bBelakangBfr').prop('src', (data.bBelakangBfr));
                    $('#bKananBfr').prop('src', (data.bKananBfr));
                    $('#bKiriBfr').prop('src', (data.bKiriBfr));

                    $('#bDepan').prop('src', (data.bDepan));
                    $('#bBelakang').prop('src', (data.bBelakang));
                    $('#bKanan').prop('src', (data.bKanan));
                    $('#bKiri').prop('src', (data.bKiri));
                    $('#modal_edit_terima').modal('show');
                }

            });
        });

        $('body').on('click', '.edit_terimabooking', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('edit_terima_booking')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id_terima_booking').val(data.id);
                    $('#id_terima_booking_kendaraan').val(data.id_kendaraan);
                    $('#tgl_peminjaman_booking').val(data.tanggal);
                    $('#modal_edit_terimabooking').modal('show');
                }

            });
        });

        $('body').on('click', '.tolak_pengajuan', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('tolak_pengajuan')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id_ket_Ditolak').val(data.id);
                    $('#modal_tolak_pengajuan').modal('show');
                }
            });
        });

        $('body').on('click', '.lihat_keterangan', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('lihat_keterangan')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#ket_Ditolak_lihat').val(data.ket_Ditolak);
                    $('#modal_lihat_keterangan').modal('show');
                }
            });
        });

    });
</script>
@endsection