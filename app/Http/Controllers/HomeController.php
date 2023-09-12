<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Inventaris;
use App\Models\Handphone;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Tamu;
use App\Models\Kendaraan_satpam;


use App\Models\Kategori;
use App\Models\Arsip;
use App\Models\Maintenance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventarisExport;
use App\Exports\MaintenanceExport;
use App\Models\Kendaraan;
use Facade\FlareClient\Http\Response;
use Hash;
use PDF;
use Carbon\Carbon;
use DateTime;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    function compressImage($source, $destination, $quality)
    {
    }



    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//

    public function pegawai()
    {
        $pegawai = Pegawai::all();
        $pegawaiedit = Pegawai::all();
        return view('pegawai', ['pegawai' => $pegawai, 'pegawaiedit' => $pegawaiedit]);
    }

    public function simpan_pegawai(Request $request)
    {
        $simpan = DB::table('pegawai')->insert([
            'nip' => $request->post('nip'),
            'nama' => $request->post('nama'),
            'divisi' => $request->post('divisi'),
            'bagian' => $request->post('bagian'),
            'jabatan' => $request->post('jabatan'),
        ]);
        if ($simpan) {
            Session::flash('sukses', 'Data berhasil disimpan.');
        } else {
            Session::flash('sukses', 'Data gagal disimpan.');
        }
        return redirect('pegawai');
    }

    public function edit_pegawai(Request $request)
    {
        $data = Pegawai::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function update_pegawai(Request $request)

    {
        $data = array(
            'nama' => $request->post('nama'),
            'jabatan' => $request->post('jabatan'),
            'wilayah' => $request->post('wilayah'),
            'area' => $request->post('area'),
            'status' => 1,
        );
        $simpan = DB::table('pegawai')->where('id', '=', $request->post('id'))->update($data);
        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('pegawai')->with("sukses", "berhasil diubah");
    }

    public function pegawai_hapus($id)
    {
        // hapus kategori berdasarkan id yang dipilih
        $handphone = Pegawai::find($id);
        $handphone->delete();

        return redirect('pegawai')->with("sukses", " berhasil dihapus");
    }

    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//


    public function kendaraan()
    {
        $nama = Auth::user()->name;
        $role = Auth::user()->role;
        if ($role == 1) {
            $kendaraan = Kendaraan::where('jenisKendaraan', 'roda dua')->orderBy('divisi', 'DESC')->get();
            $kendaraanEmpat = Kendaraan::where('jenisKendaraan', 'roda empat')->orderBy('divisi', 'DESC')->get();
        } else {
            $kendaraan = Kendaraan::where('jenisKendaraan', 'roda dua')->where('divisi', '=', $nama)->get();
            $kendaraanEmpat = Kendaraan::where('jenisKendaraan', 'roda empat')->where('divisi', '=', $nama)->get();
        }
        $kendaraan_coba = Kendaraan::orderBy('id', 'DESC')->get();



        $kendaraanedit = Kendaraan::all();
        return view('kendaraan', ['kendaraan' => $kendaraan, 'kendaraanedit' => $kendaraanedit, 'kendaraan_coba' => $kendaraan_coba, 'kendaraanEmpat' => $kendaraanEmpat]);
    }

    public function simpan_kendaraan(Request $request)
    {
        $simpan = DB::table('kendaraan')->insert([
            'jenisKendaraan' => $request->post('jenisKendaraan'),
            'noSTNK' => $request->post('noSTNK'),
            'noPolisi' => $request->post('noPolisi'),
            'noMesin' => $request->post('noMesin'),
            'noRangka' => $request->post('noRangka'),
            'merek' => $request->post('merek'),
            'warna' => $request->post('warna'),
            'status' => 1,
            'divisi' => $request->post('divisi'),
        ]);


        if ($simpan) {
            Session::flash('status', 'Data berhasil disimpan.');
        } else {
            Session::flash('status', 'Data gagal disimpan.');
        }
        return redirect('kendaraan');
    }

    public function edit_kendaraan(Request $request)
    {
        $data = Kendaraan::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function edit_last_servis(Request $request)
    {
        $data = Kendaraan::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function update_kendaraan(Request $request)

    {
        $data = array(
            'jenisKendaraan' => $request->post('jenisKendaraan'),
            'noSTNK' => $request->post('noSTNK'),
            'noPolisi' => $request->post('noPolisi'),
            'noMesin' => $request->post('noMesin'),
            'noRangka' => $request->post('noRangka'),
            'merek' => $request->post('merek'),
            'warna' => $request->post('warna'),
            'status' => 1,
            'divisi' => $request->post('divisi'),

        );
        $simpan = DB::table('kendaraan')->where('id', '=', $request->post('id'))->update($data);
        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('kendaraan')->with("sukses", "berhasil diubah");
    }

    public function update_last_servis(Request $request)

    {
        $data = array(
            'last_servis' => $request->post('last_servis'),
            'last_servis_date' => $request->post('last_servis_date'),
        );
        $simpan = DB::table('kendaraan')->where('id', '=', $request->post('id_last_servis'))->update($data);
        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('kendaraan')->with("sukses", "berhasil diubah");
    }

    public function kendaraan_hapus($id)
    {
        // hapus kategori berdasarkan id yang dipilih
        $kendaraan = Kendaraan::find($id);
        $kendaraan->delete();

        return redirect('kendaraan')->with("sukses", "inventaris berhasil dihapus");
    }

    public function edit_ketersediaan(Request $request)
    {
        $data = Kendaraan::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function update_ketersediaan(Request $request)

    {
        $data = array(
            'status' => $request->post('status'),
        );
        $simpan = DB::table('kendaraan')->where('id', '=', $request->post('id_ketersediaan'))->update($data);
        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('kendaraan')->with("sukses", "berhasil diubah");
    }

    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//

    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//


    public function peminjaman()
    {
        $nama = Auth::user()->name;
        $role = Auth::user()->role;

        $tes = Peminjaman::where('status', '!=', 3)->where('status', '!=', 6)->with('pegawai')->whereRelation('pegawai', 'divisi', $nama)->get();
        // dd($tes);
        $peminjaman_status = Peminjaman::where('id', '=', 114)->value('status');
        $peminjaman_noForm = Peminjaman::where('id', '=', 114)->value('noForm');
        $peminjaman_disetujuiOleh = Peminjaman::first()->value('disetujuiOleh');

        if ($role == 1) {
            $pegawai = Pegawai::all();
            $pegawaibooking = Pegawai::all();
            $peminjaman = Peminjaman::orderBy('id', 'DESC')->get();
        } else {
            $pegawai = Pegawai::where('divisi', '=', $nama)->get();
            $pegawaibooking = Pegawai::where('divisi', '=', $nama)->get();
            $peminjaman = Peminjaman::with('pegawai')->whereRelation('pegawai', 'divisi', $nama)->orderBy('id', 'DESC')->get();
        }

        $pegawaiedit = Pegawai::all();
        $kendaraan = Kendaraan::all();

        $getMaxid = DB::table('peminjaman')->max('id'); //10
        $getValue = Peminjaman::where('id', '=', $getMaxid)->value('noForm'); //SEKPER/14.07.22/12
        $getValuenoForm = explode('/', $getValue); //SEKPER/14.07.22/12 Jadi array

        // $kendaraan_available = Kendaraan::where('id', '!=', 5)->where('status', '=', '1')->get();
        $kendaraan_available = Kendaraan::where('id', '!=', 5)->where('jenisKendaraan', '=', 'roda empat')->get();
        $kendaraan_availablebooking = Kendaraan::where('id', '!=', 5)->where('status', '=', 1)->where('jenisKendaraan', '=', 'roda empat')->get();
        $kendaraan_availablebookingedit = Kendaraan::where('id', '!=', 5)->where('status', '=', 1)->orwhere('status', '=', 3)->get();

        return view('peminjaman', ['peminjaman' => $peminjaman, 'kendaraan' => $kendaraan, 'pegawai' => $pegawai, 'pegawaiedit' => $pegawaiedit, 'kendaraan_available' => $kendaraan_available, 'pegawaibooking' => $pegawaibooking, 'kendaraan_availablebooking' => $kendaraan_availablebooking, 'kendaraan_availablebookingedit' => $kendaraan_availablebookingedit, 'peminjaman_status' => $peminjaman_status, 'peminjaman_disetujuiOleh' => $peminjaman_disetujuiOleh, 'peminjaman_noForm' => $peminjaman_noForm, 'tes' => $tes, 'getValuenoForm' => $getValuenoForm]);
    }

    public function simpan_peminjaman(Request $request)
    {
        $simpan = DB::table('peminjaman')->insert([
            'tanggal' => $request->post('tanggal'),
            'noForm' => $request->post('noForm'),
            'id_pegawai' => $request->post('id_pegawai'),
            'id_kendaraan' => 5,
            'namaSupir' => $request->post('namaSupir'),
            'lamaPinjam' => $request->post('lamaPinjam'),
            'keperluan' => $request->post('keperluan'),
            'status'    => 5,
        ]);


        if ($simpan) {
            Session::flash('status', 'Data berhasil disimpan.');
        } else {
            Session::flash('status', 'Data gagal disimpan.');
        }
        return redirect('peminjaman')->with("sukses", "Berhasil di tambah");
    }

    public function simpan_booking(Request $request)
    {
        $simpan = DB::table('peminjaman')->insert([
            'tanggal' => $request->post('tanggal'),
            'id_kendaraan' => $request->post('id_kendaraanbooking'),
            'id_pegawai' => $request->post('id_pegawaibooking'),
            'namaSupir' => $request->post('namaSupir'),
            'lamaPinjam' => $request->post('lamaPinjam'),
            'keperluan' => $request->post('keperluan'),
            'disetujuiOleh' => 1,
            'status'    => 4,
        ]);
        $simpanstatusbooking = DB::table('kendaraan')->where('id', '=', $request->post('id_kendaraanbooking'))->update(['status' => 3]);

        if ($simpan) {
            Session::flash('status', 'Data berhasil disimpan.');
        } else {
            Session::flash('status', 'Data gagal disimpan.');
        }
        return redirect('peminjaman')->with("sukses", "Berhasil Booking");
    }

    public function tolak_pengajuan(Request $request)
    {
        $data = Peminjaman::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function lihat_keterangan(Request $request)
    {
        $data = Peminjaman::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function update_tolak_pengajuan(Request $request)

    {
        $data = array(
            'ket_Ditolak' => $request->post('ket_Ditolak'),
            'status' => 6
        );

        $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_ket_Ditolak'))->update($data);
        if ($simpan) {
            Session::flash('status', 'Peminjaman Berhasil di Tolak.');
        } else {
            Session::flash('status', 'Peminjaman gagal di Tolak.');
        }
        return redirect('peminjaman')->with("sukses", "berhasil diubah");
    }

    public function edit_peminjaman(Request $request)
    {
        $data = Peminjaman::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function edit_peminjaman_booking(Request $request)
    {
        $data = Peminjaman::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function update_booking(Request $request)

    {
        $skb = DB::table('peminjaman')->where('id', '=', $request->post('id_booking'))->value('id_kendaraan'); //5
        if ($skb == $request->post('id_kendaraanbooking')) {
            $data = array(
                'tanggal' => $request->post('tanggal'),
                'id_kendaraan' => $request->post('id_kendaraanbooking'),
                'id_pegawai' => $request->post('id_pegawai'),
                'namaSupir' => $request->post('namaSupir'),
                'lamaPinjam' => $request->post('lamaPinjam'),
                'keperluan' => $request->post('keperluan'),
            );
        } else {
            $usk = DB::table('peminjaman')->where('id', '=', $request->post('id_booking'))->value('id_kendaraan');
            DB::table('kendaraan')->where('id', '=', $usk)->update(['status' => 1]);

            $data = array(
                'tanggal' => $request->post('tanggal'),
                'id_kendaraan' => $request->post('id_kendaraanbooking'),
                'id_pegawai' => $request->post('id_pegawai'),
                'namaSupir' => $request->post('namaSupir'),
                'lamaPinjam' => $request->post('lamaPinjam'),
                'keperluan' => $request->post('keperluan'),
            );

            DB::table('kendaraan')->where('id', '=', $request->post('id_kendaraanbooking'))->update(['status' => 3]);
        }

        $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_booking'))->update($data);

        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('peminjaman')->with("sukses", "berhasil diubah");
    }

    public function peminjaman_hapusbooking($id)
    {
        $skb = Peminjaman::where('id', '=', $id)->value('id_kendaraan');
        DB::table('kendaraan')->where('id', '=', $skb)->update(['status' => 1]);
        // hapus kategori berdasarkan id yang dipilih
        $peminjaman = Peminjaman::find($id);
        $peminjaman->delete();

        return redirect('peminjaman')->with("sukses", "berhasil dihapus");
    }

    public function pengajuan_hapusbooking($id)
    {
        $skb = Peminjaman::where('id', '=', $id)->value('id_kendaraan');
        DB::table('kendaraan')->where('id', '=', $skb)->update(['status' => 1]);
        // hapus kategori berdasarkan id yang dipilih
        $peminjaman = Peminjaman::find($id);
        $peminjaman->delete();

        return redirect('pengajuan')->with("sukses", "berhasil dihapus");
    }

    public function pengajuan_hapus($id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->delete();
        return redirect('pengajuan')->with("sukses", "berhasil dihapus");
    }

    public function pengajuan_verif_spv($id)
    {
        DB::table('peminjaman')->where('id', '=', $id)->update(['status' => 1]);
        return redirect('pengajuan')->with("sukses", "berhasil diterima");
    }

    public function pengajuan_verif_spv_booking($id)
    {
        DB::table('peminjaman')->where('id', '=', $id)->update(['disetujuiOleh' => 2]);
        return redirect('pengajuan')->with("sukses", "berhasil diterima");
    }


    public function update_peminjaman(Request $request)

    {
        $data = array(
            'tanggal' => $request->post('tanggal'),
            'noForm' => $request->post('noForm'),
            'id_pegawai' => $request->post('id_pegawai'),
            'namaSupir' => $request->post('namaSupir'),
            'lamaPinjam' => $request->post('lamaPinjam'),
            'keperluan' => $request->post('keperluan'),
        );


        $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id'))->update($data);
        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('peminjaman')->with("sukses", "berhasil diubah");
    }

    public function peminjaman_hapus($id)
    {
        // hapus kategori berdasarkan id yang dipilih
        $peminjaman = Peminjaman::find($id);
        $peminjaman->delete();

        return redirect('peminjaman')->with("sukses", "berhasil dihapus");
    }


    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//

    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//


    public function pengajuan()
    {
        $pengajuan = Peminjaman::orderBy('id', 'DESC')->get();
        $pengajuanedit = Pegawai::all();
        $kendaraan =  Kendaraan::where('id', '!=', 5)->where('status', '=', 1)->where('jenisKendaraan', '=', 'roda empat')->get();

        return view('pengajuan', ['pengajuan' => $pengajuan, 'pengajuanedit' => $pengajuanedit, 'kendaraan' => $kendaraan]);
    }


    public function edit_pengajuan(Request $request)
    {
        $data = Peminjaman::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function update_pengajuan(Request $request)

    {
        $data = array(
            'id_kendaraan' => $request->post('id_kendaraan'),
            'disetujuiOleh' => "Sekper",
            'status' => 2,
        );

        $data2 = DB::table('kendaraan_satpam')->insert([
            'id_peminjaman' => $request->post('id'),
            'status' => 1,
        ]);

        $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id'))->update($data);


        $simpanstatuspegawai = DB::table('kendaraan')->where('id', '=', $request->post('id_kendaraan'))->update(['status' => 2]);


        if ($simpan) {
            Session::flash('status', 'Data berhasil diterima.');
        } else {
            Session::flash('status', 'Data gagal diterima.');
        }
        return redirect('pengajuan')->with("sukses", "berhasil");
    }



    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//

    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//


    public function surat_jalan($id)
    {
        $peminjaman = Peminjaman::find($id);
        return view('surat_jalan', ['peminjaman' => $peminjaman]);
    }


    public function edit_peminjaman_selesai(Request $request)
    {
        $data = Peminjaman::findOrFail($request->get('id'));
        echo json_encode($data);
    }


    public function update_selesai(Request $request)

    {
        $messages = [
            'required' => ':attribute wajib diisi cuy!!!',
            // 'gt' => 'nilai tidak boleh kurang dari km sebelumnya -> :gt ',
            'max' => ':attribute harus diisi maksimal :max karakter ya cuy!!!',
        ];

        $validator = DB::table('peminjaman')->where('id', '=', $request->post('id_selesai'))->value('kmAwal');
        $this->validate($request, [
            'kmAkhir' => 'required|gt:' . $validator,
        ], $messages);

        $image_kmakhir = $request->file('foto_kmakhir');
        if ($image_kmakhir) {
            $fotoakhir = 'kmakhir-' . time() . $image_kmakhir->getClientOriginalName();
            Image::make($request->file('foto_kmakhir'))->resize(400, 400)->save($fotoakhir);
            $data['foto_kmakhir'] = $fotoakhir;
            $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_selesai'))->update($data);
        }

        $image_bDepan = $request->file('bDepan');
        if ($image_bDepan) {
            $bDepan = 'bDepan-' . time() . $image_bDepan->getClientOriginalName();
            Image::make($request->file('bDepan'))->resize(400, 400)->save($bDepan);
            $data['bDepan'] = $bDepan;
            $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_selesai'))->update($data);
        }

        $image_bBelakang = $request->file('bBelakang');
        if ($image_bBelakang) {
            $bBelakang = 'bBelakang-' . time() . $image_bBelakang->getClientOriginalName();
            Image::make($request->file('bBelakang'))->resize(400, 400)->save($bBelakang);
            $data['bBelakang'] = $bBelakang;
            $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_selesai'))->update($data);
        }

        $image_bKanan = $request->file('bKanan');
        if ($image_bKanan) {
            $bKanan = 'bKanan-' . time() . $image_bKanan->getClientOriginalName();
            Image::make($request->file('bKanan'))->resize(400, 400)->save($bKanan);
            $data['bKanan'] = $bKanan;
            $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_selesai'))->update($data);
        }

        $image_bKiri = $request->file('bKiri');
        if ($image_bKiri) {
            $bKiri = 'bKiri-' . time() . $image_bKiri->getClientOriginalName();
            Image::make($request->file('bKiri'))->resize(400, 400)->save($bKiri);
            $data['bKiri'] = $bKiri;
            $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_selesai'))->update($data);
        }

        $data = array(
            'kmAkhir' => $request->post('kmAkhir'),
            'keluhan' => $request->post('keluhan')
        );
        $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_selesai'))->update($data);

        $id_kendaraan = DB::table('peminjaman')->where('id', '=', $request->post('id_selesai'))->value('id_kendaraan');
        DB::table('kendaraan')->where('id', '=', $id_kendaraan)->update(['kmAkhir' => $request->post('kmAkhir')]);

        $simpanstatusmobil = DB::table('kendaraan')->where('id', '=', $request->post('id_kendaraan_edit'))->update(['status' => 1]);

        if ($simpan) {
            Session::flash('status', 'Data berhasil diterima.');
        } else {
            Session::flash('status', 'Data gagal diterima.');
        }
        return redirect('peminjaman')->with("sukses", "berhasil");
    }


    public function update_validasifotoawal(Request $request)

    {
        $image1 = $request->file('foto_kmawal');
        if ($image1) {
            $fotoawal = 'kmawal-' . time() . $image1->getClientOriginalName();
            Image::make($request->file('foto_kmawal'))->resize(400, 400)->save($fotoawal);
            $data['foto_kmawal'] = $fotoawal;
            $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_selesai_validasi'))->update($data);
        }

        $image2 = $request->file('bDepanBfr');
        if ($image2) {
            $bDepanBfr = 'bagDepan-' . time() . $image2->getClientOriginalName();
            Image::make($request->file('bDepanBfr'))->resize(400, 400)->save($bDepanBfr);
            $data['bDepanBfr'] = $bDepanBfr;
            $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_selesai_validasi'))->update($data);
        }

        $image3 = $request->file('bBelakangBfr');
        if ($image3) {
            $bBelakangBfr = 'bagBelakang-' . time() . $image3->getClientOriginalName();
            Image::make($request->file('bBelakangBfr'))->resize(400, 400)->save($bBelakangBfr);
            $data['bBelakangBfr'] = $bBelakangBfr;
            $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_selesai_validasi'))->update($data);
        }

        $image4 = $request->file('bKananBfr');
        if ($image4) {
            $bKananBfr = 'bagKanan-' . time() . $image4->getClientOriginalName();
            Image::make($request->file('bKananBfr'))->resize(400, 400)->save($bKananBfr);
            $data['bKananBfr'] = $bKananBfr;
            $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_selesai_validasi'))->update($data);
        }

        $image5 = $request->file('bKiriBfr');
        if ($image5) {
            $bKiriBfr = 'bagKiri-' . time() . $image5->getClientOriginalName();
            Image::make($request->file('bKiriBfr'))->resize(400, 400)->save($bKiriBfr);
            $data['bKiriBfr'] = $bKiriBfr;
            $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_selesai_validasi'))->update($data);
        }

        $data = array(
            'kmAwal' => $request->post('kmAwal'),
        );

        $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_selesai_validasi'))->update($data);

        if ($simpan) {
            Session::flash('status', 'Data berhasil diterima.');
        } else {
            Session::flash('status', 'Data gagal diterima.');
        }
        return redirect('peminjaman')->with("sukses", "berhasil");
    }

    public function edit_terima(Request $request)
    {
        $data = Peminjaman::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function edit_terima_booking(Request $request)
    {
        $data = Peminjaman::findOrFail($request->get('id'));
        echo json_encode($data);
    }


    public function update_terima(Request $request)
    {


        $tglkembali = DB::table('peminjaman')->where('id', '=', $request->post('id_terima'))->value('tgl_kembali'); //13-8-2022

        $tglawal = DB::table('peminjaman')->where('id', '=', $request->post('id_terima'))->value('tanggal'); //09-8-2022
        $penjumlahan = DB::table('peminjaman')->where('id', '=', $request->post('id_terima'))->value('lamaPinjam'); //1

        $tgl1 = new DateTime($tglawal);
        $tgl2 = new DateTime($request->post('tgl_kembali'));
        $jarak = $tgl2->diff($tgl1);
        $echojarak = $jarak->format('%d');
        // dd($echojarak);

        if ($echojarak > $penjumlahan) {
            $terlambat = 'terlambat';
        } else {
            $terlambat = 'tidak terlambat';
        }

        $data = array(
            'tgl_kembali' => $request->post('tgl_kembali'),
            'catatan_sekper' => $request->post('catatan_sekper'),
            // 'terlambat' => $request->post('terlambat'),
            'terlambat' => $terlambat,
            'status' => 3,
        );
        $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_terima'))->update($data);

        if ($simpan) {
            Session::flash('status', 'Data berhasil diterima.');
        } else {
            Session::flash('status', 'Data gagal diterima.');
        }
        return redirect('pengajuan')->with("sukses", "berhasil");
    }

    public function update_terima_booking(Request $request)
    {

        $data = array(
            'disetujuiOleh' => "Sekper",
            'noForm' => $request->post('noForm'),
            'status' => 2,
        );

        $data2 = DB::table('kendaraan_satpam')->insert([
            'id_peminjaman' => $request->post('id_terima'),
            'status' => 1,
        ]);

        $simpan = DB::table('peminjaman')->where('id', '=', $request->post('id_terima'))->update($data);

        DB::table('kendaraan')->where('id', '=', $request->post('id_terima_booking_kendaraan'))->update(['status' => 2]);

        if ($simpan) {
            Session::flash('status', 'Data berhasil diterima.');
        } else {
            Session::flash('status', 'Data gagal diterima.');
        }
        return redirect('pengajuan')->with("sukses", "berhasil");
    }

    public function detail_peminjaman($id)
    {
        $peminjaman = Peminjaman::find($id);
        return view('detail_peminjaman', ['peminjaman' => $peminjaman]);
    }

    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//

    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//

    public function tamu()
    {
        $tamu_get = Tamu::where('status', '=', 1)->count();
        if ($tamu_get == 0) {
            $tamu = Tamu::orderBy('id', 'DESC')->where('status', '=', 2)->get();
        } else {
            $tamu = Tamu::orderBy('id', 'DESC')->where('status', '=', 1)->get();
        }
        $record_tamu = Tamu::orderBy('id', 'DESC')->where('status', '=', 2)->get();
        $tamuedit = Tamu::orderBy('id', 'DESC')->get();
        return view('tamu', ['tamu' => $tamu, 'record_tamu' => $record_tamu, 'tamu_get' => $tamu_get]);
    }

    public function simpan_tamu(Request $request)
    {
        // $fotoawal = $request->file('foto_kmawal')->getClientOriginalName();
        // $fototamu = $request->file('foto')->getClientOriginalName();

        $file = $request->file('foto');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = public_path();
        $file->move($tujuan_upload, $nama_file);

        $nama_petugas = Auth::user()->name;
        $simpan = DB::table('tamu')->insert([
            'waktu_masuk' => $request->post('waktu_masuk'),
            'no_identitas' => $request->post('no_identitas'),
            'nama' => $request->post('nama'),
            'no_tlp' => $request->post('no_tlp'),
            'perihal' => $request->post('perihal'),
            'divisi_tujuan' => $request->post('divisi_tujuan'),
            'asal_instansi' => $request->post('asal_instansi'),
            'alamat' => $request->post('alamat'),
            'no_kendaraan' => $request->post('no_kendaraan'),
            'status'    => 1,
            'foto' => $nama_file,
            'nama_petugas' => $nama_petugas,
        ]);

        if ($simpan) {
            Session::flash('status', 'Data berhasil disimpan.');
        } else {
            Session::flash('status', 'Data gagal disimpan.');
        }
        return redirect('tamu')->with("sukses", "Berhasil di tambah");
    }

    public function edit_tamu(Request $request)
    {
        $data = Tamu::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function update_tamu(Request $request)

    {

        if (!empty($request->file('foto_update'))) {
            $data = array(
                'waktu_masuk' => $request->post('waktu_masuk'),
                'no_identitas' => $request->post('no_identitas'),
                'nama' => $request->post('nama'),
                'no_tlp' => $request->post('no_tlp'),
                'perihal' => $request->post('perihal'),
                'divisi_tujuan' => $request->post('divisi_tujuan'),
                'asal_instansi' => $request->post('asal_instansi'),
                'alamat' => $request->post('alamat'),
                'no_kendaraan' => $request->post('no_kendaraan'),
                'status'    => 1,
                // 'foto' => $nama_file,
            );

            $simpan = DB::table('tamu')->where('id', '=', $request->post('id'))->update($data);

            $file = $request->file('foto_update');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = public_path();
            $file->move($tujuan_upload, $nama_file);

            $data2 = array('foto' => $nama_file);

            $simpan2 = DB::table('tamu')->where('id', '=', $request->post('id'))->update($data2);

            if ($simpan) {
                Session::flash('status', 'Data berhasil diupdate.');
            } else {
                Session::flash('status', 'Data gagal diupdate.');
            }
            return redirect('tamu')->with("sukses", "berhasil diubah");
        } else {
            $data = array(
                'waktu_masuk' => $request->post('waktu_masuk'),
                'no_identitas' => $request->post('no_identitas'),
                'nama' => $request->post('nama'),
                'no_tlp' => $request->post('no_tlp'),
                'perihal' => $request->post('perihal'),
                'divisi_tujuan' => $request->post('divisi_tujuan'),
                'asal_instansi' => $request->post('asal_instansi'),
                'alamat' => $request->post('alamat'),
                'no_kendaraan' => $request->post('no_kendaraan'),
                'status'    => 1,
                // 'foto' => $nama_file,
            );

            $simpan = DB::table('tamu')->where('id', '=', $request->post('id'))->update($data);


            if ($simpan) {
                Session::flash('status', 'Data berhasil diupdate.');
            } else {
                Session::flash('status', 'Data gagal diupdate.');
            }
            return redirect('tamu')->with("sukses", "berhasil diubah");
        }
    }

    public function tamu_hapus($id)
    {
        // hapus kategori berdasarkan id yang dipilih
        $tamu = Tamu::find($id);
        $tamu->delete();

        return redirect('tamu')->with("sukses", "berhasil dihapus");
    }

    public function tamu_keluar($id)
    {
        // hapus kategori berdasarkan id yang dipilih
        $tamu_keluar = Tamu::find($id);
        $data = array(
            'waktu_keluar' => date("Y-m-d h:i:s"),
            'status'    => 2,
        );
        $simpan2 = DB::table('tamu')->where('id', '=', $id)->update($data);
        return redirect('tamu')->with("sukses", "berhasil");
    }

    public function detail_tamu($id)
    {
        $tamu = Tamu::find($id);
        return view('detail_tamu', ['tamu' => $tamu]);
    }

    public function tambah_ajax(Request $request)
    {
        $contact = new Tamu;
        $contact->waktu_masuk    = $request->waktu_masuk;
        $contact->no_identitas    = $request->no_identitas;
        $contact->nama    = $request->nama;
        $contact->no_tlp    = $request->no_tlp;
        $contact->perihal    = $request->perihal;
        $contact->divisi_tujuan    = $request->divisi_tujuan;
        $contact->asal_instansi = $request->asal_instansi;
        $contact->alamat = $request->alamat;
        $contact->no_kendaraan = $request->no_kendaraan;
        $contact->foto = $request->foto_tamu_tambah;
        $contact->save();

        if ($contact) {
            #tampilkan message sukses
            $arr = array('msg' => 'Berhasil di Input', 'status' => true);
        }
        return Response()->json($arr);
    }
    public function tamu_tambah()
    {
        return view('tamu_tambah');
    }

    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//

    public function user()
    {
        $user = User::all();
        return view('user', ['user' => $user]);
    }

    public function simpan_user(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi cuy!!!',
            'min' => ':attribute harus diisi minimal :min karakter ya cuy!!!',
            'confirmed' => ':belum sama',
        ];

        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);

        $password = $request->post('password');
        $hashedPassword = Hash::make($password);
        $simpan = DB::table('users')->insert([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' =>  $hashedPassword,
            'role' => $request->post('role'),
        ]);
        if ($simpan) {
            Session::flash('sukses', 'Data berhasil disimpan.');
        } else {
            Session::flash('sukses', 'Data gagal disimpan.');
        }
        return redirect('user');
    }

    public function edit_user(Request $request)
    {
        $data = User::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function update_user(Request $request)

    {
        $data = array(
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'role' => $request->post('role'),
        );
        $simpan = DB::table('users')->where('id', '=', $request->post('id'))->update($data);
        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('user')->with("sukses", "berhasil diubah");
    }

    public function user_hapus($id)
    {
        // hapus kategori berdasarkan id yang dipilih
        $user = User::find($id);
        $user->delete();

        return redirect('user')->with("sukses", " berhasil dihapus");
    }

    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//

    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//

    public function gpass()
    {
        return view('ganti_password');
    }

    public function simpan_gpass(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi cuy!!!',
            'min' => ':attribute harus diisi minimal :min karakter ya cuy!!!',
            'confirmed' => ':belum sama',
        ];

        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);

        $password = $request->post('password');
        $hashedPassword = Hash::make($password);
        $simpan = DB::table('users')->insert([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' =>  $hashedPassword,
            'role' => $request->post('role'),
        ]);
        if ($simpan) {
            Session::flash('sukses', 'Data berhasil disimpan.');
        } else {
            Session::flash('sukses', 'Data gagal disimpan.');
        }
        return redirect('user');
    }


    public function update_gpass(Request $request)

    {
        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);

        $password = $request->post('password');
        $hashedPassword = Hash::make($password);
        $data = array(
            'password' => $hashedPassword,
        );
        $simpan = DB::table('users')->where('id', '=', Auth::user()->id)->update($data);
        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('user')->with("sukses", "berhasil diubah");
    }

    // public function user_hapus($id)
    // {
    //     // hapus kategori berdasarkan id yang dipilih
    //     $user = User::find($id);
    //     $user->delete();

    //     return redirect('user')->with("sukses", " berhasil dihapus");
    // }

    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//

    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//




    // public function simpan_kendaraan(Request $request)
    // {
    //     $simpan = DB::table('kendaraan')->insert([
    //         'jenisKendaraan' => $request->post('jenisKendaraan'),
    //         'noSTNK' => $request->post('noSTNK'),
    //         'noPolisi' => $request->post('noPolisi'),
    //         'noMesin' => $request->post('noMesin'),
    //         'noRangka' => $request->post('noRangka'),
    //         'merek' => $request->post('merek'),
    //         'warna' => $request->post('warna'),
    //         'status' => 1,
    //     ]);


    //     if ($simpan) {
    //         Session::flash('status', 'Data berhasil disimpan.');
    //     } else {
    //         Session::flash('status', 'Data gagal disimpan.');
    //     }
    //     return redirect('kendaraan');
    // }

    // public function edit_kendaraan(Request $request)
    // {
    //     $data = Kendaraan::findOrFail($request->get('id'));
    //     echo json_encode($data);
    // }
    public function kendaraanSatpam()
    {
        $kendaraanSatpam = Kendaraan_satpam::orderBy('id', 'DESC')->where('status', '=', 1)->get();
        $kendaraanSatpamout =  Kendaraan_satpam::orderBy('id', 'DESC')->where('status', '=', 2)->get();
        $kendaraanSatpamlog = Kendaraan_satpam::orderBy('id', 'DESC')->where('status', '=', 3)->get();
        // $logsatpam =  Kendaraan_satpam::all();
        return view('kendaraanSatpam', ['kendaraanSatpam' => $kendaraanSatpam, 'kendaraanSatpamlog' => $kendaraanSatpamlog, 'kendaraanSatpamout' => $kendaraanSatpamout]);
    }

    public function kendaraanSatpam_keluar($id)
    {

        $namaPetugas = Auth::user()->name;
        $data = array(
            'status' => 2,
            'nama_petugas' => $namaPetugas,
            'waktu_keluar' => date("Y-m-d h:i:s"),
        );
        $simpan = DB::table('kendaraan_satpam')->where('id', '=', $id)->update($data);

        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('kendaraanSatpam')->with("sukses", "berhasil Keluar");
    }



    public function kendaraanSatpam_detail_qrcode($id)
    {

        $peminjaman = Peminjaman::find($id);
        $kendaraanSatpamqrcode =  Kendaraan_satpam::where('id_peminjaman', '=', $id)->value('id');
        return view('detail_qrcode', ['peminjaman' => $peminjaman, 'kendaraanSatpamqrcode' => $kendaraanSatpamqrcode]);
    }

    public function kendaraanSatpam_kembali($id)

    {
        $data = array(
            'waktu_kembali' => date("Y-m-d h:i:s"),
            'status' => 3,
        );
        $simpan = DB::table('kendaraan_satpam')->where('id', '=', $id)->update($data);
        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('kendaraanSatpam')->with("sukses", "berhasil kembali");
    }


    // public function kendaraan_hapus($id)
    // {
    //     // hapus kategori berdasarkan id yang dipilih
    //     $kendaraan = Kendaraan::find($id);
    //     $kendaraan->delete();

    //     return redirect('kendaraan')->with("sukses", "inventaris berhasil dihapus");
    // }


    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//

    public function laporan_peminjaman()
    {
        $pegawai = Pegawai::all();
        $pegawaiedit = Pegawai::all();
        return view('pegawai', ['pegawai' => $pegawai, 'pegawaiedit' => $pegawaiedit]);
        return view('laporan_peminjaman');
    }

    public function laporan_hasil(Request $req)
    {
        $dari = $req->dari;
        $sampai = $req->sampai;

        $laporan = Peminjaman::whereDate('tanggal', '>=', $dari)
            ->whereDate('tanggal', '<=', $sampai)
            ->orderBy('id', 'desc')->get();

        return view('laporan_peminjaman', ['laporan' => $laporan, 'dari' => $dari, 'sampai' => $sampai]);
    }



    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------//



    //KATEGORI----------------------------------------------------------------//

    public function kategori()
    {
        $kategori = Kategori::all();
        return view('kategori', ['kategori' => $kategori]);
    }

    public function simpankategori(Request $request)
    {
        $simpan = DB::table('kategori')->insert([
            'nama' => $request->post('nama'),
            'keterangan' => $request->post('keterangan'),
        ]);
        if ($simpan) {
            Session::flash('sukses', 'Data berhasil disimpan.');
        } else {
            Session::flash('sukses', 'Data gagal disimpan.');
        }
        return redirect('kategori');
    }

    public function editkategori(Request $request)
    {
        $data = Kategori::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function updatekategori(Request $request)

    {
        $data = array(
            'nama' => $request->post('nama'),
            'keterangan' => $request->post('keterangan'),
        );
        $simpan = DB::table('kategori')->where('id', '=', $request->post('id'))->update($data);
        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('kategori')->with("sukses", "berhasil diubah");
    }

    public function hapuskategori($id)
    {
        // hapus kategori berdasarkan id yang dipilih
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect('kategori')->with("sukses", " berhasil dihapus");
    }

    //END KATEGORI----------------------------------------------------------------//

    //ARSIP----------------------------------------------------------------//

    public function arsip(Request $request)
    {
        // $multipleKat = $request->post('carikat');
        // if (is_null($multipleKat)) {
        //     $implode = $request->post('carikat');
        // } else {
        //     $implode = implode(',', $multipleKat);
        // }
        // dd($implode);

        $implode = $request->post('carikat');
        if (is_null($implode)) {
            $arsip = Arsip::all();
        } else {
            $arsip = Arsip::where('id_kategori', 'LIKE', '%,' . $implode . ',%')->orWhere('id_kategori', 'LIKE', '%,' . $implode)->orwhere('id_kategori', 'LIKE', '%' . $implode . ',%')->orWhere('id_kategori',  $implode)->get();
            // $arsip = Arsip::all();
        }



        $selectkategori = Kategori::all();
        return view('arsip', ['arsip' => $arsip, 'selectkategori' => $selectkategori]);
    }

    public function simpanarsip(Request $request)
    {
        $file = $request->file('fileupload');
        $ext = $request->file('fileupload')->extension();
        $namafile =  $request->post('noArsip') . "-" . time() . "-" . $file->getClientOriginalName();
        $tujuan_upload = 'arsip_file';
        $file->move($tujuan_upload, $namafile);

        $multipleKat = $request->post('kategori');
        if (is_null($multipleKat)) {
            $implode = $request->post('kategori');
        } else {
            $implode = implode(',', $multipleKat);
        }

        $idpetugas = Auth::user()->id;

        $simpan = DB::table('arsip')->insert([
            'waktuUpload' => Carbon::now(),
            'noArsip' => $request->post('noArsip'),
            'nama' => $request->post('nama'),
            'id_kategori' => $implode,
            'id_petugas' => $idpetugas,
            'keterangan' => $request->post('keterangan'),
            'file' => $namafile,
            'jenisFile' => $ext,

        ]);
        if ($simpan) {
            Session::flash('sukses', 'Data berhasil disimpan.');
        } else {
            Session::flash('sukses', 'Data gagal disimpan.');
        }
        return redirect('arsip');
    }

    // public function editkategori(Request $request)
    // {
    //     $data = Kategori::findOrFail($request->get('id'));
    //     echo json_encode($data);
    // }

    // public function updatekategori(Request $request)

    // {
    //     $data = array(
    //         'nama' => $request->post('nama'),
    //         'keterangan' => $request->post('keterangan'),
    //     );
    //     $simpan = DB::table('kategori')->where('id', '=', $request->post('id'))->update($data);
    //     if ($simpan) {
    //         Session::flash('status', 'Data berhasil diupdate.');
    //     } else {
    //         Session::flash('status', 'Data gagal diupdate.');
    //     }
    //     return redirect('kategori')->with("sukses", "berhasil diubah");
    // }

    // public function hapuskategori($id)
    // {
    //     // hapus kategori berdasarkan id yang dipilih
    //     $kategori = Kategori::find($id);
    //     $kategori->delete();

    //     return redirect('kategori')->with("sukses", " berhasil dihapus");
    // }
}
