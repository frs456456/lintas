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
                                    <h3 class="panel-title">Data Tamu</h3>
                                    <button type="button" class="btn btn-success btn-primary waves-effect waves-light tambah_pinjam" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                                        Tambah</button>
                                    <!--<a href="{{ url('/tamu_tambah') }}" class=" btn btn-md btn-warning"><i class="ti-plus"></i> Tambah</a>-->
                                </div>


                            </div>
                        </div>
                    </div> <!-- End row -->
                </div>
            </div>

        </div>
    </div>
</div>



<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs navtab-bg">
            <li class="">
                <a href="#home" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">RECORD Tamu</span>
                </a>
            </li>
            <li class="active">
                <a href="#profile" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                    <span class="hidden-xs">Tamu Masuk</span>
                </a>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="home">
                <div class="table-responsive">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Tanggal Masuk</th>
                                <th>Nama</th>
                                <th>Perihal</th>
                                <th>Divisi Tujuan</th>
                                <th>Asal Instansi</th>
                                <th>Nomor Tlp</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach($record_tamu as $record_tamu)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$record_tamu->waktu_masuk}}</td>
                                <td>{{$record_tamu->nama}}</td>
                                <td>{{$record_tamu->perihal}}</td>
                                <td>{{$record_tamu->divisi_tujuan}}</td>
                                <td>{{$record_tamu->asal_instansi}}</td>
                                <td>{{$record_tamu->no_tlp}}</td>

                                <td class="text-center">
                                    <?php
                                    if ($record_tamu->status == 1) { ?> <a href="{{ url('/tamu/keluar/'.$tamu->id) }}" class=" btn btn-xs btn-primary" onclick="return confirm('Tamu Keluar ??')"> Keluar</a>

                                        <a href="{{ url('/detail_tamu'.$record_tamu->id) }}" class=" btn btn-xs btn-primary"><i class="ti-eye"></i></a>

                                        <button type="button" class="btn btn-xs btn-success edit_tamu" data-id="{{$record_tamu->id}}"><i class="fa fa-pencil"></i> Ubah</button>

                                        <a href="{{ url('/tamu/hapus/'.$record_tamu->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="fa fa-trash"> Hapus</i></a> <?php  } else { ?>
                                        <a href="{{ url('/detail_tamu'.$record_tamu->id) }}" class=" btn btn-xs btn-primary"><i class="ti-eye"></i></a>

                                        <a href="{{ url('/tamu/hapus/'.$record_tamu->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="fa fa-trash"> Hapus</i></a> <?php }                                     ?>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane active" id="profile">
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Tanggal Masuk</th>
                                <th>Nama</th>
                                <th>Perihal</th>
                                <th>Divisi Tujuan</th>
                                <th>Asal Instansi</th>
                                <th>Nomor Tlp</th>
                                <!-- <th>Status</th> -->
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($tamu_get == 0) { ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            <?php
                            } else { ?>
                                @php
                                $no = 1;
                                @endphp
                                @foreach($tamu as $tamu)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$tamu->waktu_masuk}}</td>
                                    <td>{{$tamu->nama}}</td>
                                    <td>{{$tamu->perihal}}</td>
                                    <td>{{$tamu->divisi_tujuan}}</td>
                                    <td>{{$tamu->asal_instansi}}</td>
                                    <td>{{$tamu->no_tlp}}</td>
                                    <!--   <td><?php if ($tamu->status == 1) { ?><button type="button" class="btn btn-warning btn-xs waves-effect waves-light">Masuk</button>
                                        <?php }
                                                if ($tamu->status == 2) { ?>
                                            <button class="btn btn-primary btn-xs waves-effect waves-light">Selesai</button>
                                        <?php } ?>
                                    </td> -->
                                    <td class="text-center">
                                        <?php
                                        if ($tamu->status == 1) { ?> <a href="{{ url('/tamu/keluar/'.$tamu->id) }}" class=" btn btn-xs btn-primary" onclick="return confirm('Tamu Keluar ??')"> Keluar</a>

                                            <a href="{{ url('/detail_tamu'.$tamu->id) }}" class=" btn btn-xs btn-primary"><i class="ti-eye"></i></a>

                                            <button type="button" class="btn btn-xs btn-success edit_tamu" data-id="{{$tamu->id}}"><i class="fa fa-pencil"></i> Ubah</button>

                                            <a href="{{ url('/tamu/hapus/'.$tamu->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="fa fa-trash"> Hapus</i></a> <?php  } else { ?> <a href="{{ url('/detail_tamu'.$tamu->id) }}" class=" btn btn-xs btn-primary"><i class="ti-eye"></i></a>

                                            <!-- <button type="button" class="btn btn-xs btn-success edit_tamu" data-id="{{$tamu->id}}"><i class="fa fa-pencil"></i> Ubah</button> -->

                                            <a href="{{ url('/tamu/hapus/'.$tamu->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="fa fa-trash"> Hapus</i></a> <?php }                                     ?>

                                    </td>
                                </tr>
                                @endforeach
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
<!-- end row -->


<!-- MODAL TAMBAH DATA -->
<!-- MODAL TAMBAH DATA -->
<div id="myModal" class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add_tamu" method="POST" enctype="multipart/form-data" class="frm_add_tamu" action="{{route('simpan_tamu')}}">
                    @csrf
                    <div class="form-group"><label class="control-label">Tanggal Kunjungan</label>
                        <div>
                            <input type="datetime-local" id="waktu_masuk_tamu" name="waktu_masuk" placeholder="Tanggal Kunjungan" class="form-control">
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor Identitas</label>
                        <div><input type="text" id="no_identitas_tamu" name="no_identitas" placeholder="KTP / SIM" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Nama </label>
                        <div><input type="text" id="nama_tamu" name="nama" placeholder="Nama" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group"><label class="control-label">Nomor Tlp</label>
                        <div><input type="text" id="no_tlp_tamu" name="no_tlp" placeholder="Nomor Tlp" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Perihal</label>
                        <div><textarea id="perihal_tamu" name="perihal" class="form-control"></textarea></div>
                    </div>
                    <div class="form-group"><label class="control-label">Divisi Tujuan</label>
                        <div><select id="divisi_tujuan_tamu" name="divisi_tujuan" class="id_pegawai" id="">
                                <option value="">- Pilih Divisi</option>
                                <option value="TI">TI</option>
                                <option value="">Lainnya</option>
                            </select></div>
                    </div>
                    <div class="form-group"><label class="control-label">Asal Instansi</label>
                        <div><input type="text" id="asal_instansi_tamu" name="asal_instansi" placeholder="Asal Instansi" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Alamat</label>
                        <div><textarea id="alamat_tamu" name="alamat" class="form-control"></textarea></div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor Kendaraan</label>
                        <div><input type="text" id="no_kendaraan_tamu" name="no_kendaraan" placeholder="Nomor Kendaraan" class="form-control">
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Foto</label>
                        <div><input type="file" accept="image/*" capture id="foto_tamu_tambah" name="foto" placeholder="foto" class="form-control" required>
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
                <form name="frm_add" id="frm_add" action="{{route('update_tamu')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Tanggal Masuk</label>
                        <div>
                            <input type="datetime-local" name="waktu_masuk" id="waktu_masuk" class="form-control">
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor Identitas</label>
                        <div><input type="text" name="no_identitas" id="no_identitas" class="form-control">
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Nama</label>
                        <div><input type="text" name="nama" id="nama" class="form-control">
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor Tlp</label>
                        <div><input type="text" name="no_tlp" id="no_tlp" class="form-control">
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Perihal</label>
                        <div><textarea name="perihal" id="perihal" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group"><label class="control-label">Divisi Tujuan</label>
                        <div><select name="divisi_tujuan" class="form-control" id="divisi_tujuan">
                                <option value="">- Pilih Divisi</option>
                                <option value="TI">TI</option>
                                <option value="">Lainnya</option>
                            </select></div>
                    </div>
                    <div class="form-group"><label class="control-label">Asal Instansi</label>
                        <div><input type="text" name="asal_instansi" id="asal_instansi" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Alamat</label>
                        <div><textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Nomor Kendaraan</label>
                        <div><input type="text" name="no_kendaraan" id="no_kendaraan" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group text-center"><label class="control-label">Foto Tamu </label>
                        <div><img class="img-rounded" width="100px" src="{{ url('/data_file_tamu/'.$record_tamu->foto) }}" id="foto_tamu">
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div><input type="file" name="foto_update" id="foto_update"></div>
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

    $('#noForm_auto').val('SEKPER/14.07.22/__');

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
        $('body').on('click', '.edit_tamu', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('edit_tamu')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#waktu_masuk').val(data.waktu_masuk);
                    $('#no_identitas').val(data.no_identitas);
                    $('#nama').val(data.nama);
                    $('#no_tlp').val(data.no_tlp);
                    $('#perihal').val(data.perihal);
                    $('#divisi_tujuan option[value="' + data.divisi_tujuan + '"]').prop(
                        'selected', true);
                    $('#asal_instansi').val(data.asal_instansi);
                    $('#alamat').val(data.alamat);
                    $('#no_kendaraan').val(data.no_kendaraan);
                    // $('#foto_update').val(data.foto);
                    // $('#foto_update').val(data.foto);
                    $("#foto_tamu").text('').prop('src', data.foto);
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

        // $('#frm_add_tamu').on('submit', function(event) {
        //     event.preventDefault();
        //     //MENGAMBIL ID INPUT
        //     // waktu_masuk_tamu = $('#waktu_masuk_tamu').val();
        //     // no_identitias_tamu = $('#no_identitias_tamu').val();
        //     // nama_tamu = $('#nama_tamu').val();
        //     // no_tlp_tamu = $('#no_tlp_tamu').val();
        //     // perihal_tamu = $('#perihal_tamu').val();
        //     // divisi_tujuan_tamu = $('#divisi_tujuan_tamu').val();
        //     // asal_instansi_tamu = $('#asal_instansi_tamu').val();
        //     // alamat_tamu = $('#alamat_tamu').val();
        //     // no_kendaraan_tamu = $('#no_kendaraan_tamu').val();
        //     // foto_tamu_tambah = $('#foto_tamu_tambah').val();
        //     var data = $('#frm_add_tamu').serialize();
        //     var files = $('#foto_tamu_tambah')[0].files;

        //     $.ajax({
        //         url: "{{route('tambah_ajax')}}",
        //         type: "POST",
        //         data: data,
        //         // {
        //         //     "_token": "{{ csrf_token() }}",
        //         //     waktu_masuk_tamu: waktu_masuk,
        //         //     no_identitas_tamu: no_identitas_tamu,
        //         //     nama_tamu: nama_tamu,
        //         //     no_tlp_tamu: no_tlp_tamu,
        //         //     perihal_tamu: perihal_tamu,
        //         //     divisi_tujuan_tamu: divisi_tujuan_tamu,
        //         //     asal_instansi_tamu: asal_instansi_tamu,
        //         //     alamat_tamu: alamat_tamu,
        //         //     no_kendaraan_tamu: no_kendaraan_tamu,
        //         //     // foto_tamu_tambah: foto_tamu_tambah,
        //         // },
        //         //TAMPIL SUKSES MESSAGE
        //         success: function(response) {
        //             $('#res_message').show();
        //             $('#res_message').html(response.msg);
        //             $('#msg_div').removeClass('d-none');

        //             document.getElementById("frm_add_tamu").reset();

        //             setTimeout(function() {
        //                 $('#res_message').hide();
        //                 $('#msg_div').hide();
        //             }, 4000);

        //         },

        //     });
        // });

    });



    let camera_button = document.querySelector("#start-camera");
    let video = document.querySelector("#video");
    let click_button = document.querySelector("#click-photo");
    let canvas = document.querySelector("#canvas");

    camera_button.addEventListener('click', async function() {
        let stream = await navigator.mediaDevices.getUserMedia({
            video: true,
            audio: false
        });
        video.srcObject = stream;
    });

    click_button.addEventListener('click', function() {
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        let image_data_url = canvas.toDataURL('image/jpeg');
        // data url of the image
        console.log(image_data_url);
    });
</script>

@endsection