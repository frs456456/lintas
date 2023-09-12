@extends('master')

@section('konten')

<?php

use Illuminate\Support\Facades\Auth;

$roleadmin = Auth::user()->role;
?>

<div class="container">

    <!-- Page-Title -->

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">
                                        <h4>Invoice</h4>
                                    </div> -->
                <div class="panel-body">

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="invoice-title">
                                <h4 class="pull-right"></h4>
                                <h4>DETAIL TAMU</h4>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-6">
                                    <address>
                                        <strong>Pegawai :</strong><br>
                                        Nomor Identitas : {{$tamu->no_identitas}}<br>
                                        Nama : {{$tamu->nama}}<br>
                                        Nomor Tlp : {{$tamu->no_tlp}}<br>
                                        Perihal : {{$tamu->perihal}}<br>
                                        Divisi Tujuan : {{$tamu->divisi_tujuan}}<br>
                                        Asal Instansi : {{$tamu->asal_instansi}}<br>
                                        Alamat : {{$tamu->alamat}}<br>
                                        Nomor Kendaraan : {{$tamu->no_kendaraan}}<br>

                                    </address>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <address>
                                        <strong>FOTO :</strong><br>
                                        <img class="img-rounded" width="200px" src="{{ url('/'.$tamu->foto) }}">
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <address>

                                    </address>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <address>
                                        <strong>Waktu Masuk :</strong><br>
                                        <?php echo date('d F Y, h:i:s A', strtotime($tamu->waktu_masuk)) ?><br>
                                        <strong>Waktu Keluar :</strong><br>
                                        <?php if ($tamu->waktu_keluar == null) {
                                            echo date($tamu->waktu_keluar);
                                        } else {
                                            echo date('d F Y, h:i:s A', strtotime($tamu->waktu_keluar));
                                        }  ?>
                                        <strong>Nama Petugas : </strong><br>
                                        <?php echo $tamu->nama_petugas ?>
                                        <br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>


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