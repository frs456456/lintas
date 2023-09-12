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
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs navtab-bg">
                                <li class="">
                                    <a href="#home" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Kendaraan Kembali</span>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="#profile" data-toggle="tab" aria-expanded="true">
                                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                                        <span class="hidden-xs">Kendaraan Keluar</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#messages" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                        <span class="hidden-xs">Log Kendaraan</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#settings" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                        <span class="hidden-xs">Settings</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane" id="home">
                                    <div class="table-responsive">
                                        <table id="datatable-responsive" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%">No</th>
                                                    <th>Nama</th>
                                                    <th>Kendaraan</th>
                                                    <th>Nomor Polisi</th>
                                                    <th>No Form</th>
                                                    <th>Waktu Keluar</th>
                                                    <th>option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $no = 1;
                                                @endphp
                                                @foreach($kendaraanSatpamout as $kendaraanSatpamout)
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$kendaraanSatpamout->peminjaman->pegawai->nama}}</td>
                                                    <td>{{$kendaraanSatpamout->peminjaman->kendaraan->merek}}</td>
                                                    <td>{{$kendaraanSatpamout->peminjaman->kendaraan->noPolisi}}</td>
                                                    <td>{{$kendaraanSatpamout->peminjaman->noForm}}</td>
                                                    <td>{{$kendaraanSatpamout->waktu_keluar}}</td>
                                                    <td class="text-center">
                                                        <a href="{{url('/kendaraanSatpam/kembali/'.$kendaraanSatpamout->id) }}" class="btn btn-xs btn-warning">Kembali</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane active" id="profile">

                                    <div id="log"></div>

                                    <div style="width: 250px" id="reader"></div>
                                    </br>
                                    <div class="table-responsive">
                                        <div class="table-responsive">
                                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th width="1%">No</th>
                                                        <th>Nama</th>
                                                        <th>Kendaraan</th>
                                                        <th>No Polisi</th>
                                                        <th>No Form</th>
                                                        <th>option</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $no = 1;
                                                    @endphp
                                                    @foreach($kendaraanSatpam as $kendaraanSatpam)
                                                    <tr>
                                                        <td>{{$no++}}</td>
                                                        <td>{{$kendaraanSatpam->peminjaman->pegawai->nama}}</td>
                                                        <td>{{$kendaraanSatpam->peminjaman->kendaraan->merek}}</td>
                                                        <td>{{$kendaraanSatpam->peminjaman->kendaraan->noPolisi}}</td>
                                                        <td>{{$kendaraanSatpam->peminjaman->noForm}}</td>

                                                        <td class="text-center">
                                                            <?php if ($kendaraanSatpam->status == 1) { ?>
                                                                <a href="{{url('/kendaraanSatpam/keluar/'.$kendaraanSatpam->id) }}" class="btn btn-xs btn-primary">Keluar</a>
                                                            <?php } else { ?>
                                                                <a href="{{url('/kendaraanSatpam/kembali/'.$kendaraanSatpam->id) }}" class="btn btn-xs btn-warning">Kembali</a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="messages">
                                    <div class="table-responsive">
                                        <table id="datatable-keytable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%">No</th>
                                                    <th>nip</th>
                                                    <th>Nama</th>
                                                    <th>Bagian</th>
                                                    <th>Unit Kerja</th>
                                                    <th>Jabatan</th>
                                                    <th>Kendaraan</th>
                                                    <th>Nomor Polisi</th>
                                                    <th>Waktu Keluar</th>
                                                    <th>Waktu Kembali</th>
                                                    <th>Nama Petugas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $no = 1;
                                                @endphp
                                                @foreach($kendaraanSatpamlog as $logsatpam)
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$logsatpam->peminjaman->pegawai->nip}}</td>
                                                    <td>{{$logsatpam->peminjaman->pegawai->nama}}</td>
                                                    <td>{{$logsatpam->peminjaman->pegawai->divisi}}</td>
                                                    <td>{{$logsatpam->peminjaman->pegawai->bagian}}</td>
                                                    <td>{{$logsatpam->peminjaman->pegawai->jabatan}}</td>
                                                    <td>{{$logsatpam->peminjaman->kendaraan->merek}}</td>
                                                    <td>{{$logsatpam->peminjaman->kendaraan->noPolisi}}</td>
                                                    <td>{{$logsatpam->waktu_keluar}}</td>
                                                    <td>{{$logsatpam->waktu_kembali}}</td>
                                                    <td>{{$logsatpam->nama_petugas}}</td>


                                                </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings">
                                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <!-- end row -->


                </div>
            </div>

        </div>
    </div>
</div>

<?php
$detail_qr = 0;
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="assets/js/html5-qrcode.min.js"></script>
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

    });

    function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        var old = console.log;
        var logger = document.getElementById('log');
        console.log = function(message) {
            if (typeof message == 'object') {
                logger.innerHTML += (JSON && JSON.stringify ? JSON.stringify(message) : String(message)) + '<br />';
            } else {
                logger.innerHTML += message + '<br />';
            }
        }

        // console.log(`Scan result: ${decodedText}<br /><a class="btn btn-sm btn-warning" href="${decodedText}">Tampilkan</a></br></br>`, decodedResult);
        console.log(`<div class="alert alert-warning">Klik Tombol untuk menampilkan Detail Peminjaman</div>
        <a class="btn btn-sm btn-warning" href="${decodedText}"> Tampilkan </a></br></br>`, decodedResult);

        html5QrcodeScanner.clear();
        // ^ this will stop the scanner (video feed) and clear the scan area.
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: 250
        });
    html5QrcodeScanner.render(onScanSuccess);



    // (function() {
    //     if (!console) {
    //         console = {};
    //     }
    //     var old = console.log;
    //     var logger = document.getElementById('log');
    //     console.log = function(message) {
    //         if (typeof message == 'object') {
    //             logger.innerHTML += (JSON && JSON.stringify ? JSON.stringify(message) : String(message)) + '<br />';
    //         } else {
    //             logger.innerHTML += message + '<br />';
    //         }
    //     }
    // })();
</script>
@endsection