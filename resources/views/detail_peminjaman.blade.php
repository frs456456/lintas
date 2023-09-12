@extends('master')

@section('konten')

<?php

use Illuminate\Support\Facades\Auth;

$roleadmin = Auth::user()->role;
?>

<div class="container">

    <!-- Page-Title -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">
                                        <h4>Invoice</h4>
                                    </div> -->
                <div class="panel-body">

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="invoice-title">
                                <h4 class="pull-right">Nomor Formulir # {{$peminjaman->noForm}}</h4>
                                <h4>DETAIL Peminjaman</h4>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-6">
                                    <address>
                                        <strong>Pegawai :</strong><br>
                                        Pemohon : {{$peminjaman->pegawai->nama}}<br>
                                        NIP : {{$peminjaman->pegawai->nip}}<br>
                                        Divisi : {{$peminjaman->pegawai->divisi}}<br>
                                        Jabatan : {{$peminjaman->pegawai->jabatan}}
                                    </address>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <address>
                                        <strong>Peminjaman :</strong><br>
                                        Lama Peminjaman : {{$peminjaman->lamaPinjam}} Hari<br>
                                        Keperluan : {{$peminjaman->keperluan}}<br>
                                        Disetujui Oleh : {{$peminjaman->disetujuiOleh}}<br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <address>
                                        <strong>Pengemudi :</strong>
                                        {{$peminjaman->namaSupir}}<br>
                                        <strong>Keluhan dan Saran :</strong><br>
                                        {{$peminjaman->keluhan}}
                                    </address>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <address>
                                        <strong>Tanggal Peminjaman :</strong>
                                        <?php echo date('d F Y', strtotime($peminjaman->tanggal)) ?><br>
                                        <strong>Tanggal Kembali :</strong>
                                        <?php echo date('d F Y', strtotime($peminjaman->tgl_kembali)) ?>
                                        <br><br>
                                        <strong>Status Pengembalian :</strong>
                                        <?php echo ($peminjaman->terlambat) ?>
                                        <br><br>
                                        <strong>Catatan Sekper :</strong>
                                        <?php echo ($peminjaman->catatan_sekper) ?>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Detail Peminjaman</strong></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td><strong>Jenis Kendaraan</strong></td>
                                                    <td class="text-center"><strong>Merek</strong></td>
                                                    <td class="text-center"><strong>Nomor Polisi</strong></td>
                                                    <td class="text-center"><strong>Nomor Mesin</strong>
                                                    </td>
                                                    <td class="text-right"><strong>Nomor Rangka</strong></td>

                                                    <td class="text-center"><strong>Warna</strong></td>
                                                    <td class="text-center"><strong>Km Awal</strong></td>
                                                    <td class="text-center"><strong>Km Akhir</strong></td>
                                                    <td class="text-center"><strong>Foto Awal</strong></td>
                                                    <td class="text-center"><strong>Foto Akhir</strong></td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                <tr>
                                                    <td>{{$peminjaman->kendaraan->jenisKendaraan}}</td>
                                                    <td class="text-center">{{$peminjaman->kendaraan->merek}}</td>
                                                    <td class="text-center">{{$peminjaman->kendaraan->noPolisi}}</td>
                                                    <td class="text-center">{{$peminjaman->kendaraan->noMesin}}</td>
                                                    <td class="text-center">{{$peminjaman->kendaraan->noRangka}}</td>
                                                    <td class="text-center">{{$peminjaman->kendaraan->warna}}</td>
                                                    <td class="text-center">{{$peminjaman->kmAwal}}</td>
                                                    <td class="text-center">{{$peminjaman->kmAkhir}}</td>
                                                    <td class="text-center"><img class="img-rounded" width="150px" src="{{ url($peminjaman->foto_kmawal) }}"></td>
                                                    <td class="text-center"><img class="img-rounded" width="150px" src="{{ url($peminjaman->foto_kmakhir) }}"></td>

                                                </tr>


                                            </tbody>
                                        </table>
                                        <!-- ------------------------------------------------- -->
                                        <h3 class="panel-title"><strong>Sebelum Digunakan</strong></h3>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td class="text-center"><strong>Bagian Depan</strong></td>
                                                    <td class="text-center"><strong>Bagian Belakang</strong></td>
                                                    <td class="text-center"><strong>Bagian Kanan</strong>
                                                    </td>
                                                    <td class="text-right"><strong>Bagian Kiri</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                <tr>
                                                    <td class="text-center"><img class="img-rounded" width="150px" src="{{ url($peminjaman->bDepanBfr) }}"></td>
                                                    <td class="text-center"><img class="img-rounded" width="150px" src="{{ url($peminjaman->bBelakangBfr) }}"></td>
                                                    <td class="text-center"> <img class="img-rounded" width="150px" src="{{ url($peminjaman->bKananBfr) }}"></td>
                                                    <td class="text-center"><img class="img-rounded" width="150px" src="{{ url($peminjaman->bKiriBfr) }}"></td>
                                                </tr>


                                            </tbody>
                                        </table>

                                        <h3 class="panel-title"><strong>Setelah Digunakan</strong></h3>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td class="text-center"><strong>Bagian Depan</strong></td>
                                                    <td class="text-center"><strong>Bagian Belakang</strong></td>
                                                    <td class="text-center"><strong>Bagian Kanan</strong>
                                                    </td>
                                                    <td class="text-right"><strong>Bagian Kiri</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center"><img class="img-rounded" width="150px" src="{{ url($peminjaman->bDepan) }}"></td>
                                                    <td class="text-center"><img class="img-rounded" width="150px" src="{{ url($peminjaman->bBelakang) }}"></td>
                                                    <td class="text-center"> <img class="img-rounded" width="150px" src="{{ url($peminjaman->bKanan) }}"></td>
                                                    <td class="text-center"><img class="img-rounded" width="150px" src="{{ url($peminjaman->bKiri) }}"></td>
                                                </tr>
                                            </tbody>
                                        </table>


                                    </div>

                                    <div class="hidden-print">
                                        <div class="pull-right">
                                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end row -->
                </div> <!-- panel body -->
            </div> <!-- end panel -->

        </div> <!-- end col -->

    </div>

    <footer class="footer">
        2016 - 2020 © Xadmino.
    </footer>

</div>

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

    $("#id_pegawai option:selected").text();

    $("#id_kendaraan").select2({
        width: '100%'
    });
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
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

    });
</script>
@endsection