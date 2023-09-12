@extends('master')

@section('konten')

<?php

use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;
use App\Models\Kendaraan_satpam;
use function PHPUnit\Framework\isNull;

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
                    <!--  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Ketersediaan Kendaraan</h3>
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive" style="height: 200px;overflow: scroll;">
                                                <div class="table-responsive">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- End row -->
                    <div class="row">
                        <div class="col-sm-6 col-lg-4">
                            <a data-toggle="modal" data-target="#myModal" href="#">
                                <div class="panel panel-primary text-center">
                                    <div class="panel-heading text-white">
                                        <h3 class="text-white"><i class="fa fa-plus"></i><b> Pinjam</b></h3>
                                        <p class="text-muted"><b></b></p>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <a data-toggle="modal" data-target="#myModalbooking" href="#">
                                <div class="panel panel-warning text-center">
                                    <div class="panel-heading text-white">
                                        <h3 class="text-white"><i class="fa fa-plus"></i><b> Booking</b></h3>
                                        <p class="text-muted"><b></b></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <a data-toggle="modal" data-target="#myModalcek_mobil" href="#">
                                <div class="panel panel-success text-center">
                                    <div class="panel-heading text-white">
                                        <h3 class="text-white"><i class="fa fa-eye"></i><b> Ketersediaan</b></h3>
                                        <p class="text-muted"><b></b></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @foreach($tes as $tes)
                    <div class="row">
                        <div class="col-sm-6 col-lg-12">
                            <div class="panel panel-primary text-center">
                                <div class="panel-body">

                                    <h3 class="" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="
                                        No Form : {{$tes->noForm}}
                                        Pemohon : {{$tes->pegawai->nama}}
                                        Tanggal : {{$tes->tanggal}}">Status Peminjaman :</h3>
                                    <p class="text-muted"><b><?php if ($tes->status == 1) { ?><button class="btn btn-success btn-xs waves-effect waves-light">Diajukan</button>
                                            <?php }
                                                                if ($tes->status == 2) { ?>
                                                <button class="btn btn-primary btn-xs waves-effect waves-light">Proses</button>
                                            <?php }
                                                                if ($tes->status == 3) { ?>
                                                <p class="text-muted" style="font-size: 30px;"><b>Selesai</b></p>
                                            <?php }
                                                                if ($tes->status == 4 and $tes->status->disetujuiOleh == 2) { ?>
                                                <button class="btn btn-warning btn-xs waves-effect waves-light">Booked</button>
                                            <?php }
                                                                if ($tes->status == 5) { ?>
                                                <button class="btn btn-warning btn-xs waves-effect waves-light">Menunggu Verifikasi Atasan</button>
                                            <?php }
                                                                if ($tes->status == 6) { ?>
                                                <button class="btn btn-warning btn-xs waves-effect waves-light">Ditolak</button>
                                            <?php }
                                                                if ($tes->status == 4 and $tes->status == 1) { ?><button type="button" class="btn btn-primary btn-xs waves-effect waves-light">Menunggu Verifikasi Atasan</button>
                                            <?php } ?>
                                        </b></p>


                                    <div class="row">
                                        <div class="col-sm-6 col-lg-12">
                                            <div class="progress progress-lg">
                                                <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php if ($tes->status == 5) {
                                                                                                                                                                                                                        echo "20%";
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    if ($tes->status == 4 and $tes->status == 1) {
                                                                                                                                                                                                                        echo "30%";
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    if ($tes->status == 1) {
                                                                                                                                                                                                                        echo "60%";
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    if ($tes->status == 2) {
                                                                                                                                                                                                                        echo "80%";
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    if ($tes->status == 3) {
                                                                                                                                                                                                                        echo "100%";
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    if ($tes->status == 6) {
                                                                                                                                                                                                                        echo "100%";
                                                                                                                                                                                                                    } ?>">

                                                    <span><?php if ($tes->status == 5) {
                                                                echo "20% Complete";
                                                            }
                                                            if ($tes->status == 4 and $tes->status == 1) {
                                                                echo "30% Complete";
                                                            }
                                                            if ($tes->status == 1) {
                                                                echo "60% Complete";
                                                            }
                                                            if ($tes->status == 2) {
                                                                echo "80% Complete";
                                                            }
                                                            if ($tes->status == 3) {
                                                                echo "100% Complete";
                                                            }
                                                            if ($tes->status == 6) {
                                                                echo "100% Complete";
                                                            } ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Data Peminjaman Kendaraan</h3>
                                    <!--   <button type="button" class="btn btn-xs btn-default waves-effect waves-light tambah_pinjam" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                                        Pinjam</button>
                                    <button type="button" class="btn btn-xs btn-default waves-effect waves-light tambah_pinjambooking" data-toggle="modal" data-target="#myModalbooking"><i class="fa fa-plus"></i>
                                        Booking</button>
                                    <button type="button" class="btn btn-default btn-xs waves-effect waves-light cek_mobil" data-toggle="modal" data-target="#myModalcek_mobil"><i class="fa fa-eye"></i>
                                        Kendaraan
                                    </button> -->
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
                                                            <th>Status</th>
                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $no = 1;
                                                        @endphp
                                                        @foreach($peminjaman as $peminjaman)
                                                        <tr>
                                                            <?php
                                                            $name = Auth::user()->name;
                                                            if ($peminjaman->pegawai->nama == $name) { ?>

                                                            <?php } ?>
                                                            <td>{{$no++}}</td>
                                                            <td>{{$peminjaman->pegawai->nama}}</td>
                                                            <td>{{$peminjaman->tanggal}}</td>
                                                            <td>{{$peminjaman->noForm}}</td>

                                                            <td>{{$peminjaman->pegawai->divisi}}</td>
                                                            <td>{{$peminjaman->namaSupir}}</td>
                                                            <td>{{$peminjaman->lamaPinjam}} Hari</td>
                                                            <td>{{$peminjaman->keperluan}}</td>
                                                            <td><?php if ($peminjaman->status == 1) { ?><button type="button" class="btn btn-default  btn-xs waves-effect waves-light">Diajukan</button>
                                                                <?php }
                                                                if ($peminjaman->status == 2) { ?>
                                                                    <button class="btn btn-default btn-xs waves-effect waves-light">Proses</button>
                                                                <?php }
                                                                if ($peminjaman->status == 3) { ?>
                                                                    <button class="btn btn-default btn-xs waves-effect waves-light">Selesai</button>
                                                                <?php }
                                                                if ($peminjaman->status == 4 and $peminjaman->disetujuiOleh == 2) { ?>
                                                                    <button class="btn btn-default btn-xs waves-effect waves-light">Booked</button>
                                                                <?php }
                                                                if ($peminjaman->status == 5) { ?>
                                                                    <button class="btn btn-default btn-xs waves-effect waves-light"><b>Menunggu Verifikasi Atasan</b></button>
                                                                <?php }
                                                                if ($peminjaman->status == 4 and $peminjaman->disetujuiOleh == 1) { ?><button type="button" class="btn btn-default btn-xs waves-effect waves-light">Menunggu Verifikasi Atasan</button>
                                                                <?php }
                                                                if ($peminjaman->status == 6) { ?><button type="button" class="btn btn-default  btn-xs waves-effect waves-light">Ditolak</button>
                                                                <?php } ?>

                                                            </td>

                                                            <?php if ($peminjaman->status == 4 and is_null($peminjaman->kmAwal)) { ?>

                                                                <td class="text-center">
                                                                    <?php if ($peminjaman->pegawai->divisi == $nama) { ?>
                                                                        <button type="button" class="btn btn-xs btn-success edit_peminjaman_booking" data-id="{{$peminjaman->id}}"><i class="fa fa-pencil"></i> Ubah</button>

                                                                        <a href="{{ url('/peminjaman/hapusbooking/'.$peminjaman->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="fa fa-trash"> Hapus</i></a>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php }
                                                            if ($peminjaman->status == 5 and is_null($peminjaman->kmAwal)) { ?>
                                                                <td class="text-center">
                                                                    <?php if ($peminjaman->pegawai->divisi == $nama) { ?>
                                                                        <button type="button" class="btn btn-xs btn-success edit_peminjaman" data-id="{{$peminjaman->id}}"><i class="fa fa-pencil"></i> Ubah</button>

                                                                        <a href="{{ url('/peminjaman/hapus/'.$peminjaman->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="fa fa-trash"> Hapus</i></a>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php }  ?>

                                                            <?php if ($peminjaman->status == 1 and is_null($peminjaman->kmAwal)) { ?>
                                                                <td class="text-center">
                                                                    <?php if ($peminjaman->pegawai->divisi == $nama) { ?>
                                                                        <button type="button" class="btn btn-xs btn-success edit_peminjaman" data-id="{{$peminjaman->id}}"><i class="fa fa-pencil"></i> Ubah</button>

                                                                        <a href="{{ url('/peminjaman/hapus/'.$peminjaman->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="fa fa-trash"> Hapus</i></a>
                                                                    <?php } ?>

                                                                </td>
                                                            <?php }
                                                            if ($peminjaman->status == 2 and is_null($peminjaman->kmAkhir)) { ?>
                                                                <td class="text-center">
                                                                    <?php
                                                                    if ($peminjaman->status == 2 and is_null($peminjaman->kmAwal) and $nama == $peminjaman->pegawai->divisi) { ?>
                                                                        <button type="button" class="btn btn-xs btn-primary validasi_fotokmawal" data-id="{{$peminjaman->id}}"><i class="ti-printer"></i> Cetak</button>

                                                                    <?php
                                                                    }
                                                                    if ($peminjaman->status == 2 and (!empty($peminjaman->kmAwal)) and $nama == $peminjaman->pegawai->divisi) { ?>

                                                                        <a href="{{ url('/surat_jalan'.$peminjaman->id) }}" class=" btn btn-xs btn-primary"><i class="ti-printer"></i> Cetak</a>
                                                                        <?php
                                                                        $kendaraan_satpam = Kendaraan_satpam::where('id_peminjaman', '=', $peminjaman->id)->value('status');
                                                                        if ($kendaraan_satpam == 3) { ?>
                                                                            <button type="button" class="btn btn-xs btn-success edit_peminjaman_selesai" data-id="{{$peminjaman->id}}"><i class="ti-check"></i> Selesai</button>
                                                                        <?php } else {
                                                                        }
                                                                        ?>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php }
                                                            if ($peminjaman->status == 2 and !empty($peminjaman->kmAkhir)) {
                                                            ?> <td class="text-center">
                                                                    <a href="{{ url('/surat_jalan'.$peminjaman->id) }}" class=" btn btn-xs btn-primary"><i class="ti-printer"></i> Cetak</a>
                                                                </td>
                                                            <?php
                                                            }
                                                            if ($peminjaman->status == 6) { ?>
                                                                <td class="text-center">
                                                                    <button type="button" class="btn btn-xs btn-warning lihat_keterangan" data-id="{{$peminjaman->id}}"><i class="ti-eye"></i></button>
                                                                </td>
                                                            <?php }
                                                            if ($peminjaman->status == 3) { ?>
                                                                <td class="text-center">
                                                                    <button class="btn btn-success btn-xs waves-effect waves-light">Selesai</button>
                                                                <?php } ?>
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
<div id="myModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>

            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('simpan_peminjaman')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Tanggal Peminjaman</label>
                        <div>
                            <input type="date" name="tanggal" id="tgl_pinjam" placeholder="Tanggal Peminjaman" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor Formulir</label>
                        <div><input type="text" name="noForm" id="noForm_auto" placeholder="Nomor Formulir" class="form-control" value="<?php
                                                                                                                                        $array_bln    = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
                                                                                                                                        $bln        = $array_bln[date('n')];
                                                                                                                                        $tahun      = date('y');

                                                                                                                                        echo ($getValuenoForm[0] + 1) . "/" . $getValuenoForm[1] . "/" . $bln . "/" . $tahun;
                                                                                                                                        ?>" required readonly>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Pemohon</label>
                        <div><select name="id_pegawai" id="id_pegawai">
                                <option value="">- Pilih pemohon</option>
                                @foreach($pegawai as $pegawai)
                                <option value="{{ $pegawai->id }}">{{ $pegawai->nama }} || {{$pegawai->divisi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group"><label class="control-label">Pengemudi</label>
                        <div><input type="text" name="namaSupir" placeholder="Pengemudi" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Lama Pinjam (Hari)</label>
                        <div><input type="number" name="lamaPinjam" placeholder="Lama Peminjaman (Hari)" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Keperluan</label>
                        <div><textarea name="keperluan" id="" cols="30" rows="10" class="form-control"></textarea></div>
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

<!-- MODAL TAMBAH Booking -->
<!-- MODAL TAMBAH Booking -->
<div id="myModalbooking" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Booking Kendaraan</h4>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('simpan_booking')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Tanggal Peminjaman</label>
                        <div>
                            <input type="date" name="tanggal" placeholder="Tanggal Peminjaman" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Pilih Kendaraan</label>
                        <div><select name="id_kendaraanbooking" id="kendaraanbooking_tambah">
                                <option value="">- Pilih kendaraan</option>
                                @foreach($kendaraan_availablebooking as $kab)
                                <option value="{{ $kab->id }}">{{ $kab->merek }} || {{$kab->noPolisi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Pemohon</label>
                        <div><select name="id_pegawaibooking" id="pegawaibooking_tambah">
                                <option value="">- Pilih pemohon</option>
                                @foreach($pegawaibooking as $pegawaibooking)
                                <option value="{{ $pegawaibooking->id }}">{{ $pegawaibooking->nama }} ||
                                    {{$pegawaibooking->divisi}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group"><label class="control-label">Pengemudi</label>
                        <div><input type="text" name="namaSupir" placeholder="Pengemudi" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Lama Pinjam (Hari)</label>
                        <div><input type="number" name="lamaPinjam" placeholder="Lama Peminjaman (Hari)" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Keperluan</label>
                        <div><textarea name="keperluan" id="" cols="30" rows="10" class="form-control"></textarea></div>
                    </div>

                    <div class="form-group"><label class="control-label"></label>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Booked</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END MODAL TAMBAH Booking -->
<!-- END MODAL TAMBAH Booking -->

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
                <form name="frm_add" id="frm_add" action="{{route('update_peminjaman')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Tanggal Peminjaman</label>
                        <div>
                            <input type="date" name="tanggal" id="tanggal" class="form-control">
                        </div>
                    </div>

                    <div class="form-group"><label class="control-label">Nomor Formulir</label>
                        <div><input type="text" name="noForm" id="noForm" placeholder="Nomor Formulir" class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Pemohon</label>
                        <div><select name="id_pegawai" id="id_pegawai" class="form-control">
                                <option value="">- Pilih pegawai</option>
                                @foreach($pegawaiedit as $pegawai)
                                <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Pengemudi</label>
                        <div><input type="text" name="namaSupir" id="namaSupir" placeholder="Nama Supir" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Lama Pinjam (Hari)</label>
                        <div><input type="number" name="lamaPinjam" id="lamaPinjam" placeholder="Lama Peminjaman (Hari)" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Keperluan</label>
                        <div><textarea name="keperluan" id="keperluan" cols="30" rows="10" class="form-control"></textarea></div>
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
<!-- END MODAL UBAH DATA -->
<!-- END MODAL UBAH DATA -->

<!-- MODAL UBAH BOOKING -->
<!-- MODAL UBAH BOOKING -->

<div id="modal_editbooking" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Ubah Booking</h4>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('update_booking')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Tanggal Peminjaman</label>
                        <div>
                            <input type="date" name="tanggal" id="tanggal_booking" class="form-control">
                        </div>
                    </div>

                    <div class="form-group"><label class="control-label">Pilih Kendaraan</label>
                        <div><select name="id_kendaraanbooking" id="id_kendaraanbookingedit" class="form-control">
                                <option value="">- Pilih kendaraan</option>
                                @foreach($kendaraan_availablebookingedit as $kab)
                                <option value="{{ $kab->id }}">{{ $kab->merek }} || {{$kab->noPolisi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Pemohon</label>
                        <div><select name="id_pegawai" id="id_pegawaibookingedit" class="form-control">
                                <option value="">- Pilih pegawai</option>
                                @foreach($pegawaiedit as $pegawai)
                                <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Pengemudi</label>
                        <div><input type="text" name="namaSupir" id="namaSupirbookingedit" placeholder="Nama Supir" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Lama Pinjam (Hari)</label>
                        <div><input type="number" name="lamaPinjam" id="lamaPinjambookingedit" placeholder="Lama Peminjaman (Hari)" class="form-control" required></div>
                    </div>
                    <div class="form-group"><label class="control-label">Keperluan</label>
                        <div><textarea name="keperluan" id="keperluanbookingedit" cols="30" rows="10" class="form-control"></textarea></div>
                    </div>

                    <div class="modal-footer">
                    </div>

                    <input type="hidden" name="id_booking" id="id_bookingedit" value="">
                    <div class="form-group"><label class="control-label"></label>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Ubah</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL UBAH BOOKING -->
<!-- END MODAL UBAH BOOKING -->

<!-- MODAL SELESAI DATA -->
<!-- MODAL SELESAI DATA -->

<div id="modal_edit_selesai" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Ubah DATA</h4>
                <!-- MENAMPILKAN PESAN ERROR -->
                @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('update_selesai')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-lg-6">

                            <div class="form-group"><label class="control-label">KM Akhir</label>
                                <div><input type="number" name="kmAkhir" id="kmAkhir" placeholder="Km Akhir" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="control-label">Lampiran Kilometer Akhir</label>
                                <div>
                                    <input type="file" name="foto_kmakhir" id="foto_kmakhir" class="form-control" accept="image/*" capture>
                                </div>
                            </div>
                            <div class="form-group"><label class="control-label">Saran dan Keluhan</label>
                                <div>
                                    <textarea class="form-control" name="keluhan" id="keluhan" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------- -->
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group"><label class="control-label">Foto Bagian Depan</label>
                                <div>
                                    <input type="file" name="bDepan" id="bDepan" class="form-control" accept="image/*" capture>
                                </div>
                            </div>
                            <div class="form-group"><label class="control-label">Foto Bagian Belakang</label>
                                <div>
                                    <input type="file" name="bBelakang" id="bBelakang" class="form-control" accept="image/*" capture>
                                </div>
                            </div>
                            <div class="form-group"><label class="control-label">Foto Sisi Kanan</label>
                                <div>
                                    <input type="file" name="bKanan" id="bKanan" class="form-control" accept="image/*" capture>
                                </div>
                            </div>
                            <div class="form-group"><label class="control-label">Foto Sisi Kiri</label>
                                <div>
                                    <input type="file" name="bKiri" id="bKiri" class="form-control" accept="image/*" capture>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                    </div>
                    <input type="hidden" name="id_selesai" id="id_selesai" value="">
                    <input type="hidden" name="id_kendaraan_edit" id="id_kendaraan_edit" value="">
                    <div class="form-group"><label class="control-label"></label>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL SELESAI DATA -->
<!-- END MODAL SELESAI DATA -->

<!-- MODAL VALIDASI FOTO -->
<!-- MODAL VALIDASI FOTO -->

<div id="validasi_fotokmawal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Silahkan isi sebelum cetak Surat Jalan</h4>
            </div>

            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('update_validasifotoawal')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group"><label class="control-label">KM Awal</label>
                                <div><input type="number" name="kmAwal" id="kmAwal" placeholder="Km Awal" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-froup"><label class="control-label">Lampiran Kilometer Awal</label>
                                <div>
                                    <input type="file" name="foto_kmawal" id="foto_kmawal" class="form-control" accept="image/*" capture>
                                </div>
                            </div>
                        </div>
                        <!-- ////////////////////////////////////////////////////////////////////////// -->
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group"><label class="control-label">Foto Bagian Depan</label>
                                <div>
                                    <input type="file" name="bDepanBfr" id="bDepanBfr" class="form-control" accept="image/*" capture>
                                </div>
                            </div>
                            <div class="form-group"><label class="control-label">Foto Bagian Belakang</label>
                                <div>
                                    <input type="file" name="bBelakangBfr" id="bBelakangBfr" class="form-control" accept="image/*" capture>
                                </div>
                            </div>
                            <div class="form-group"><label class="control-label">Foto Sisi Kanan</label>
                                <div>
                                    <input type="file" name="bKananBfr" id="bKananBfr" class="form-control" accept="image/*" capture>
                                </div>
                            </div>
                            <div class="form-group"><label class="control-label">Foto Sisi Kiri</label>
                                <div>
                                    <input type="file" name="bKiriBfr" id="bKiriBfr" class="form-control" accept="image/*" capture>
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="modal-footer">
                    </div>
                    <input type="hidden" name="id_selesai_validasi" id="id_selesai_validasi" value="">
                    <div class="form-group"><label class="control-label"></label>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL VALIDASI FOTO DATA -->
<!-- END MODAL VALIDASI FOTO DATA -->

<!-- MODAL CEK Kendaraan -->
<!-- MODAL CEK Kendaraan -->
<div id="myModalcek_mobil" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Ketersediaan Kendaraan</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="datatable-responsive" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nomor Polisi</th>
                                <th>Merek</th>
                                <th>Warna</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach($kendaraan_available as $kendaraan_available)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$kendaraan_available->noPolisi}}</td>

                                <td>{{$kendaraan_available->merek}}</td>
                                <td>{{$kendaraan_available->warna}}</td>
                                <td>
                                    <?php if ($kendaraan_available->status == 1) { ?><button type="button" class="btn btn-default btn-xs waves-effect waves-light">Tersedia</button>
                                    <?php } ?>
                                    <?php if ($kendaraan_available->status == 2) { ?><button type="button" class="btn btn-default btn-xs waves-effect waves-light">Tidak Tersedia</button>
                                    <?php } ?>
                                    <?php if ($kendaraan_available->status == 3) { ?><button type="button" class="btn btn-default btn-xs waves-effect waves-light">Booked</button>
                                    <?php }
                                    if ($kendaraan_available->status == 4) { ?><button type="button" class="btn btn-default btn-xs waves-effect waves-light">Sedang dalam perawatan</button>
                                    <?php }
                                    if ($kendaraan_available->status == 6) { ?><button type="button" class="btn btn-default btn-xs waves-effect waves-light">Digunakan Di Wilayah</button>
                                    <?php }
                                    ?>


                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- MODAL CEK Kendaraan -->
<!-- MODAL CEK Kendaraan -->

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

    $("#kendaraanbooking_tambah").select2({
        width: '100%'
    });
    $("#pegawaibooking_tambah").select2({
        width: '100%'
    });

    $("#id_pegawaibooking").select2({
        width: '100%'
    });

    $(".id_pegawai").select2({
        width: '100%'
    });

    // $('#noForm_auto').val('SEKPER/14.07.22/__');
    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);

    var today = now.getFullYear() + "-" + (month) + "-" + (day);

    $('#tgl_pinjam').val(today);

    $("#id_pegawai").val();

    $("#id_pegawai option:selected").text();

    $("#id_kendaraan").select2({
        width: '100%'
    });
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<?php
if (Count($errors) > 0) { ?>
    <script>
        $(document).ready(function() {
            $('#modal_edit_selesai').modal({
                show: true
            });
            //edit data
            $('body').on('click', '.edit_peminjaman', function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('edit_peminjaman')}}?id=" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#id').val(data.id);
                        $('#tanggal').val(data.tanggal);
                        $('#noForm').val(data.noForm);
                        $('#id_pegawai option[value="' + data.id_pegawai + '"]').prop(
                            'selected', true);
                        $('#namaSupir').val(data.namaSupir);
                        $('#lamaPinjam').val(data.lamaPinjam);
                        $('#keperluan').val(data.keperluan);
                        $('#modal_edit').modal('show');
                    }
                });
            });

            $('body').on('click', '.edit_peminjaman_selesai', function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('edit_peminjaman_selesai')}}?id=" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#id_selesai').val(data.id);
                        $('#id_kendaraan_edit').val(data.id_kendaraan);
                        $('#kmAwal').val(data.kmAwal);
                        $('#kmAkhir').val(data.kmAkhir);
                        $('#modal_edit_selesai').modal('show');
                    }

                });
            });

            $('body').on('click', '.edit_peminjaman_booking', function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('edit_peminjaman_booking')}}?id=" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#id_bookingedit').val(data.id);
                        $('#tanggal_booking').val(data.tanggal);
                        $('#id_kendaraanbookingedit option[value="' + data.id_kendaraan +
                            '"]').prop(
                            'selected', true);
                        $('#id_pegawaibookingedit option[value="' + data.id_pegawai + '"]')
                            .prop(
                                'selected', true);
                        $('#namaSupirbookingedit').val(data.namaSupir);
                        $('#lamaPinjambookingedit').val(data.lamaPinjam);
                        $('#keperluanbookingedit').val(data.keperluan);
                        $('#modal_editbooking').modal('show');
                    }

                });
            });

            $('body').on('click', '.validasi_fotokmawal', function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('edit_peminjaman_selesai')}}?id=" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#id_selesai_validasi').val(data.id);
                        $('#validasi_fotokmawal').modal('show');
                    }

                });
            });
        })
    </script>
<?php } else { ?>

    <script>
        $(document).ready(function() {
            //edit data
            $('body').on('click', '.edit_peminjaman', function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('edit_peminjaman')}}?id=" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#id').val(data.id);
                        $('#tanggal').val(data.tanggal);
                        $('#noForm').val(data.noForm);
                        $('#id_pegawai option[value="' + data.id_pegawai + '"]').prop(
                            'selected', true);
                        $('#namaSupir').val(data.namaSupir);
                        $('#lamaPinjam').val(data.lamaPinjam);
                        $('#keperluan').val(data.keperluan);
                        $('#modal_edit').modal('show');
                    }

                });
            });

            $('body').on('click', '.edit_peminjaman_selesai', function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('edit_peminjaman_selesai')}}?id=" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#id_selesai').val(data.id);
                        $('#id_kendaraan_edit').val(data.id_kendaraan);
                        $('#kmAwal').val(data.kmAwal);
                        $('#kmAkhir').val(data.kmAkhir);
                        $('#modal_edit_selesai').modal('show');
                    }

                });
            });

            $('body').on('click', '.edit_peminjaman_booking', function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('edit_peminjaman_booking')}}?id=" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#id_bookingedit').val(data.id);
                        $('#tanggal_booking').val(data.tanggal);
                        $('#id_kendaraanbookingedit option[value="' + data.id_kendaraan +
                            '"]').prop(
                            'selected', true);
                        $('#id_pegawaibookingedit option[value="' + data.id_pegawai + '"]')
                            .prop(
                                'selected', true);
                        $('#namaSupirbookingedit').val(data.namaSupir);
                        $('#lamaPinjambookingedit').val(data.lamaPinjam);
                        $('#keperluanbookingedit').val(data.keperluan);
                        $('#modal_editbooking').modal('show');
                    }

                });
            });

            $('body').on('click', '.validasi_fotokmawal', function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('edit_peminjaman_selesai')}}?id=" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#id_selesai_validasi').val(data.id);
                        $('#validasi_fotokmawal').modal('show');
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

<?php }
?>
@endsection