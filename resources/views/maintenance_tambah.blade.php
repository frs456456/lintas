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
                            <div class="alert alert-success d-none" id="msg_div">
                                <span id="res_message"></span>
                            </div>
                            Tambah Data

                            <a href="{{ url('/') }}" class="float-right btn btn-sm btn-primary">Kembali</a>
                        </div>

                        </br>
                        <div class="card-body">
                            <form name="frm_add" id="frm_add" method="POST" enctype="multipart/form-data">
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
<link rel="stylesheet" href="">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
    $("#pegawai").select2({
        width: '100%'
    });
    $("#handphone").select2({
        width: '100%'
    });
    $("#fisik").select2({
        width: '100%'
    });
    $("#fungsi").select2({
        width: '100%'
    });
    $("#m_imei").select2({
        width: '100%'
    });

    $('#frm_add').on('submit', function(event) {
        event.preventDefault();
        //MENGAMBIL ID INPUT
        pegawai = $('#pegawai').val();
        handphone = $('#handphone').val();
        fisik = $('#fisik').val();
        fungsi = $('#fungsi').val();
        m_imei = $('#m_imei').val();
        keterangan = $('#keterangan').val();
        id_pegawai_sebelumnya = $('#id_pegawai_sebelumnya').val();


        $.ajax({
            url: "{{route('tambah_coba')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                pegawai: pegawai,
                handphone: handphone,
                fisik: fisik,
                fungsi: fungsi,
                m_imei: m_imei,
                keterangan: keterangan,
                id_pegawai_sebelumnya: id_pegawai_sebelumnya,
            },
            //TAMPIL SUKSES MESSAGE
            success: function(response) {
                $('#res_message').show();
                $('#res_message').html(response.msg);
                $('#msg_div').removeClass('d-none');

                document.getElementById("frm_add").reset();

                setTimeout(function() {
                    $('#res_message').hide();
                    $('#msg_div').hide();
                }, 4000);

            },

        });
    });
</script>
@endsection