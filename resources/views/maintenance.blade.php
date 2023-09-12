@extends('master')

@section('konten')

<?php

use App\Models\Maintenance;
use App\Models\Pegawai;
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
                                    <h3 class="panel-title">Data Maintenencae</h3>
                                    <button type="button" class="btn btn-success btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModalmaintenance"><i class="fa fa-plus"></i>
                                        Tambah</button>

                                    <a href="{{ url('/maintenance/export_maintenance/') }}" class="btn btn-warning">Export Excel</a>
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="1%">No</th>
                                                            <th>Nama Pegawai</th>
                                                            <th>Jabatan</th>
                                                            <th>Wilayah</th>
                                                            <th>Area</th>
                                                            <th>Merek Handphone</th>
                                                            <th>Tipe</th>
                                                            <th>Warna</th>
                                                            <th>IMEI 1</th>
                                                            <th>IMEI 2</th>
                                                            <th>Serial Number</th>
                                                            <th>Kode Inventaris</th>
                                                            <th>NO HP</th>
                                                            <th>Pemegang Sebelumnya</th>
                                                            <th>Kondisi Fisik</th>
                                                            <th>Kondisi Fungsi</th>
                                                            <th>Kesesuaian IMEI</th>
                                                            <th>Keterangan</th>
                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $no = 1;
                                                        @endphp
                                                        @foreach($maintenance as $maintenance)
                                                        <tr>
                                                            <td>{{$no++}}</td>
                                                            <td>{{$maintenance->pegawai->nama}}</td>
                                                            <td>{{$maintenance->pegawai->jabatan}}</td>
                                                            <td>{{$maintenance->pegawai->wilayah}}</td>
                                                            <td>{{$maintenance->pegawai->area}}</td>
                                                            <td>{{$maintenance->handphone->merk}}</td>
                                                            <td>{{$maintenance->handphone->tipe}}</td>
                                                            <td>{{$maintenance->handphone->warna}}</td>
                                                            <td>{{$maintenance->handphone->imei1}}</td>
                                                            <td>{{$maintenance->handphone->imei2}}</td>
                                                            <td>{{$maintenance->handphone->serial_number}}</td>
                                                            <td>{{$maintenance->handphone->kode_inventaris}}</td>
                                                            <td>{{$maintenance->handphone->no_hp}}</td>
                                                            <td>{{$maintenance->id_pegawai_sebelumnya}}</td>
                                                            <td>{{$maintenance->fisik}}</td>
                                                            <td>{{$maintenance->fungsi}}</td>
                                                            <td>{{$maintenance->m_imei}}</td>
                                                            <td>{{$maintenance->keterangan}}</td>
                                                            <td class="text-center">

                                                                <a class="btn btn-xs btn-primary detail" data-toggle="modal" data-target="#modal-detail" data-id-detail="{{$maintenance->id}}"><i class="fa fa-eye"></i></a>

                                                                <button type="button" class="btn btn-xs btn-success edit_maintenance" data-id="{{$maintenance->id}}"><i class="fa fa-pencil"></i></button>

                                                                <a href="{{ url('/maintenance/hapus/'.$maintenance->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Yakin akan hapus data ??')"><i class="fa fa-trash"></i></a>
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
<div id="myModalmaintenance" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('simpan_maintenance')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><label class="control-label">Nama Pegawai</label>
                        <div><select name="pegawai" id="pegawai" class="theSelect">
                                <option value="">- Pilih Pegawai</option>
                                @foreach($pegawai as $pegawai)
                                <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Handphone</label>
                        <div><select name="handphone" id="handphone" class="theSelect">
                                <option value="">- Pilih Handphone</option>
                                @foreach($handphone as $handphone)
                                <option value="{{ $handphone->id }}">{{ $handphone->merk }} || Imei 1 :
                                    {{$handphone->imei1}}
                                </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="form-group"><label class="control-label" for="">Kondisi
                            Fisik</label>
                        <div><select name="fisik" id="fisik" class="theSelect">
                                <option value="">- Pilih Kondisi</option>
                                <option value="sangat baik">Sangat Baik</option>
                                <option value="baik">Baik</option>
                                <option value="rusak sedang">Rusak Sedang</option>
                                <option value="rusak parah">Rusak Parah</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label" for="">Kondisi
                            Fungsi</label>
                        <div><select name="fungsi" id="fungsi" class="theSelect">
                                <option value="">- Pilih Kondisi</option>
                                <option value="sangat baik">Sangat Baik</option>
                                <option value="baik">Baik</option>
                                <option value="rusak sedang">Rusak Sedang</option>
                                <option value="rusak parah">Rusak Parah</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label" for="">Keadaan
                            IMEI</label>
                        <div><select name="m_imei" id="m_imei" class="theSelect">
                                <option value="">- Pilih</option>
                                <option value="sesuai">Sesuai</option>
                                <option value="tidak sesuai">Tidak Sesuai</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group"><label class="control-label">Keterangan</label>
                        <div><textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group"><label class="control-label">Pegawai Sebelumnya</label>
                        <div><input type="text" name="id_pegawai_sebelumnya" id="id_pegawai_sebelumnya" class="form-control"></div>
                    </div>

                    <div class="form-group"><label class="control-label"></label>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
                    <link rel="stylesheet" href="">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
                    <script>
                        $(".theSelect").select2({
                            width: '100%'
                        });
                    </script>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END MODAL TAMBAH DATA -->
<!-- END MODAL TAMBAH DATA -->

<!-- MODAL UBAH DATA -->
<!-- MODAL UBAH DATA -->

<div id="modal_edit_maintenance" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Ubah DATA</h4>
            </div>
            <div class="modal-body">
                <form name="frm_add" id="frm_add" action="{{route('update_maintenance')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group"><label class="control-label">Nama</label>

                        </br>
                        <div>
                            <select class="form-control" name="id_pegawai" id="id_pegawai">
                                <option value="">- Pilih Pegawai</option>
                                @foreach($pegawaiedit as $pegawaiedit)
                                <option <?php if ($pegawaiedit->id == 'id_pegawai') {
                                            echo "selected='selected'";
                                        } ?> value="{{$pegawaiedit->id}}">{{$pegawaiedit->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Merek</label>
                        <div>
                            <select class="form-control" name="id_handphone" id="id_handphone">
                                <option value="">- Pilih Handphone</option>
                                @foreach($handphoneedit as $handphoneedit)
                                <option <?php if ($handphoneedit->id == 'id_handphone') {
                                            echo "selected='selected'";
                                        } ?> value="{{$handphoneedit->id}}">{{$handphoneedit->merk}} || IMEI 1 :
                                    {{$handphoneedit->imei1}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label">Kondisi
                            Fisik</label>
                        <div><select name="fisik" id="fisik_edit" class="form-control">
                                <option <?php if ($maintenance->fisik == "sangat baik") {
                                            echo "selected='selected'";
                                        } ?> value="sangat baik">Sangat Baik</option>
                                <option <?php if ($maintenance->fisik == "baik") {
                                            echo "selected='selected'";
                                        } ?> value="baik">Baik</option>
                                <option <?php if ($maintenance->fisik == "rusak sedang") {
                                            echo "selected='selected'";
                                        } ?> value="rusak sedang">Rusak Sedang</option>
                                <option <?php if ($maintenance->fisik == "rusak parah") {
                                            echo "selected='selected'";
                                        } ?> value="rusak parah">Rusak Parah</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group"><label class="control-label" for="">Kondisi
                            Fungsi</label>
                        <div><select name="fungsi" id="fungsi_edit" class="form-control">
                                <option <?php if ($maintenance->fungsi == "sangat baik") {
                                            echo "selected='selected'";
                                        } ?> value="sangat baik">Sangat Baik</option>
                                <option <?php if ($maintenance->fungsi == "baik") {
                                            echo "selected='selected'";
                                        } ?> value="baik">Baik</option>
                                <option <?php if ($maintenance->fungsi == "rusak sedang") {
                                            echo "selected='selected'";
                                        } ?> value="rusak sedang">Rusak Sedang</option>
                                <option <?php if ($maintenance->fungsi == "rusak parah") {
                                            echo "selected='selected'";
                                        } ?> value="rusak parah">Rusak Parah</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="control-label" for="">
                            IMEI</label>
                        <div>
                            <select name="m_imei" id="m_imei_edit" class="form-control">
                                <option <?php if ($maintenance->m_imei == "sesuai") {
                                            echo "selected='selected'";
                                        } ?> value="sesuai">Sesuai</option>
                                <option <?php if ($maintenance->m_imei == "tidak sesuai") {
                                            echo "selected='selected'";
                                        } ?> value="tidak sesuai">Tidak Sesuai</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group"><label class="control-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan_edit" id="keterangan_edit" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group"><label class="control-label">Pegawai Sebelumnya</label>
                        <div><input type="text" name="id_pegawai_sebelumnya" id="id_pegawai_sebelumnya" class="form-control"></div>
                    </div>

                    <div class="modal-footer">
                    </div>

                    <input type="hidden" name="id" id="id" value="{{$maintenance->id}}">
                    <div class="form-group"><label class="control-label"></label>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Ubah</button>
                    </div>
            </div>
            <link rel="stylesheet" href="">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
            <script>
                // $("#id_pegawai").select2({
                //     width: '100%'
                // });
                // $("#id_pegawai").val();
                // $("#id_pegawai option:selected").text();

                // $(".theSelect").select2({
                //     width: '100%'
                // });
            </script>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL UBAH DATA -->
<!-- END MODAL UBAH DATA -->

<!-- MODAL DETAIL -->
<!-- MODAL DETAIL -->
<div id="modal_detail" class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Detail</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="table-responsive">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <tbody>

                                <tr>
                                    <td width="30%" class="">Pegawai : </td>
                                    <td><select class="form-control" name="id_pegawai_detail" id="id_pegawai_detail" disabled>
                                            <option value="">- Pilih Pegawai</option>
                                            @foreach($pegawaidetail as $pegawaidetail)
                                            <option <?php if ($pegawaidetail->id == 'id_pegawai_detail') {
                                                        echo "selected='selected'";
                                                    } ?> value="{{$pegawaidetail->id}}">{{$pegawaidetail->nama}} || {{$pegawaidetail->jabatan}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>Merk HP :</td>
                                    <td><select class="form-control" name="id_handphone_detail" id="id_handphone_detail" disabled>
                                            <option value="">- Pilih</option>
                                            @foreach($handphonedetail as $handphonedetail)
                                            <option <?php if ($handphonedetail->id == 'id_handphone_detail') {
                                                        echo "selected='selected'";
                                                    } ?> value="{{$handphonedetail->id}}">{{$handphonedetail->merk}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>Kondisi Fisik :</td>
                                    <td><span id="fisik_detail"></span></td>
                                </tr>
                                <tr>
                                    <td>Kondisi Fungsi :</td>
                                    <td><span id="fungsi_detail"></span></td>
                                </tr>
                                <tr>
                                    <td>IMEI :</td>
                                    <td><span id="m_imei_detail"></span></td>
                                </tr>
                                <tr>
                                    <td>Keterangan :</td>
                                    <td><span id="keterangan_detail"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <link rel="stylesheet" href="">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
            <script>
                // $("#id_pegawai").select2({
                //     width: '100%'
                // });
                // $("#id_pegawai").val();
                // $("#id_pegawai option:selected").text();

                // $(".theSelect").select2({
                //     width: '100%'
                // });
            </script>

        </div>
    </div>
</div>
<!-- END MODAL DETAIL -->
<!-- END MODAL DETAIL -->
<?php
$pegawaicoba = Pegawai::where('id', '=', '12')->get();
?>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
    $(document).ready(function() {
        //edit data
        $('body').on('click', '.edit_maintenance', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('edit_maintenance')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id').val(data.id);
                    $('#id_pegawai').val(data.id_pegawai); //NAMA DATABASE NYA
                    $('#id_handphone').val(data.id_handphone);
                    $('#fisik_edit').val(data.fisik);
                    $('#fungsi_edit').val(data.fungsi);
                    $('#m_imei_edit').val(data.m_imei);
                    $('#keterangan_edit').val(data.keterangan);
                    $('#id_pegawai_sebelumnya').val(data.id_pegawai_sebelumnya);
                    $('#modal_edit_maintenance').modal('show');
                }

            });
        });

        $('body').on('click', '.detail', function() {
            var id = $(this).attr('data-id-detail');
            $.ajax({
                url: "{{route('detail_maintenance')}}?id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(datadetail) {
                    $('#id').val(datadetail.id);
                    $('#id_pegawai_detail').val(datadetail.id_pegawai); //NAMA DATABASE NYA
                    $('#id_handphone_detail').val(datadetail.id_handphone);
                    $('#fisik_detail').val(datadetail.fisik).html(datadetail.fisik);
                    $('#fungsi_detail').val(datadetail.fungsi).html(datadetail.fungsi);
                    $('#m_imei_detail').val(datadetail.m_imei).html(datadetail.m_imei);
                    $('#keterangan_detail').val(datadetail.keterangan).html(datadetail.keterangan);
                    $('#id_pegawai_sebelumnya_detail').val(datadetail.id_pegawai_sebelumnya);
                    $('#modal_detail').modal('show');
                }

            });
        });

    });
</script>
@endsection