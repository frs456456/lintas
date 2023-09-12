@extends('master')

@section('konten')

<?php

use Illuminate\Support\Facades\Auth;

$roleadmin = Auth::user()->role;

include(app_path() . '/phpqrcode/qrlib.php');
$tujuan_upload = 'data_file';

//isi qrcode jika di scan
$codeContents = $peminjaman->id;

//output gambar langsung ke browser, sebagai PNG
QRcode::png("/kendaraanSatpam/keluar/" . $codeContents . "/Sekper/TI/Tirtaasasta", $tujuan_upload . "001.png");

?>

<div class="container">

    <!-- Page-Title -->

    <div id="printableArea" class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="invoice-title">
                                <div class="hidden-print">
                                    <div class="pull-right">
                                        <a href="{{url('/kendaraanSatpam/keluar/'.$kendaraanSatpamqrcode)}}" class="btn btn-md btn-danger">Keluar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-title">
                                <img src="{{('img/logopt.png') }}" width="110" class="logo">
                                <!-- <h4 class="pull-right">DETAIL PEMINJAMAN</h4> -->

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-6">
                                    <address>
                                        <strong>Pemohon :</strong><br>
                                        Pemohon : {{$peminjaman->pegawai->nama}}<br>
                                        NIP : {{$peminjaman->pegawai->nip}}<br>
                                        Bagian : {{$peminjaman->pegawai->divisi}}<br>
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
                                        <strong>Pengemudi :</strong><br>
                                        {{$peminjaman->namaSupir}}<br>
                                        No TLP :
                                    </address>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <address>
                                        <strong>Tanggal :</strong><br>
                                        <?php echo date('d F Y', strtotime($peminjaman->tanggal)) ?> <br><br>
                                        <?php echo '<img src="' . $tujuan_upload . '001.png" />';  ?>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Data Kendaraan </strong></h3>
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
                                                </tr>

                                                <tr>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    </br>

                                </div>
                            </div>

                        </div>
                    </div> <!-- end row -->
                </div> <!-- panel body -->
            </div> <!-- end panel -->

        </div> <!-- end col -->

    </div>

    <footer class="footer">

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
<script src="assets/js/html5-qrcode.min.js"></script>
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

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }

    function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        console.log(`Scan result: ${decodedText}`, decodedResult);
    }

    // var html5QrcodeScanner = new Html5QrcodeScanner(
    //     "reader", {
    //         fps: 10,
    //         qrbox: 250
    //     });
    // html5QrcodeScanner.render(onScanSuccess);
</script>
@endsection