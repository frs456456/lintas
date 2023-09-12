@extends('master')

@section('konten')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">

                            Tambah Data

                            <a href="{{ url('/tamu') }}" class="float-right btn btn-sm btn-primary">Kembali</a>
                        </div>

                        </br>
                        <div class="card-body">
                            <form name="frm_add_tamu" id="frm_add_tamu" method="POST" enctype="multipart/form-data">
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
                                <div class="form-group"><label class="control-label">Ambil Foto</label>
                                    <div>
                                        <button class="btn btn-xs btn-success" id="start-camera">Start Camera</button>
                                        <button class="btn btn-xs btn-success" id="click-photo">Click Photo</button>
                                    </div>
                                    <div>
                                        <video id="video" width="320" height="240" autoplay></video> <br>
                                        <canvas id="canvas" width="320" height="240"></canvas>
                                    </div>
                                </div>

                                <div class="form-group"><label class="control-label"></label>
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                                </div>



                                <div class="form-group"><label class="control-label"></label>
                                    <button id="simpan" type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
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

        $('#frm_add_tamu').on('submit', function(event) {
            event.preventDefault();
            //MENGAMBIL ID INPUT
            waktu_masuk_tamu = $('#waktu_masuk_tamu').val();
            no_identitias_tamu = $('#no_identitias_tamu').val();
            nama_tamu = $('#nama_tamu').val();
            no_tlp_tamu = $('#no_tlp_tamu').val();
            perihal_tamu = $('#perihal_tamu').val();
            divisi_tujuan_tamu = $('#divisi_tujuan_tamu').val();
            asal_instansi_tamu = $('#asal_instansi_tamu').val();
            alamat_tamu = $('#alamat_tamu').val();
            no_kendaraan_tamu = $('#no_kendaraan_tamu').val();
            foto_tamu_tambah = $('#foto_tamu_tambah').val();

            $.ajax({
                url: "{{route('tambah_ajax')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    waktu_masuk_tamu: waktu_masuk_tamu,
                    no_identitas_tamu: no_identitas_tamu,
                    nama_tamu: nama_tamu,
                    no_tlp_tamu: no_tlp_tamu,
                    perihal_tamu: perihal_tamu,
                    divisi_tujuan_tamu: divisi_tujuan_tamu,
                    asal_instansi_tamu: asal_instansi_tamu,
                    alamat_tamu: alamat_tamu,
                    no_kendaraan_tamu: no_kendaraan_tamu,
                    foto_tamu_tambah: foto_tamu_tambah,
                },
                //TAMPIL SUKSES MESSAGE
                success: function(response) {
                    $('#res_message').show();
                    $('#res_message').html(response.msg);
                    $('#msg_div').removeClass('d-none');

                    document.getElementById("frm_add_tamu").reset();

                    setTimeout(function() {
                        $('#res_message').hide();
                        $('#msg_div').hide();
                    }, 4000);

                },

            });
        });

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