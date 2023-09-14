<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Models\Pegawai;


class PegawaiController extends Controller
{
    public function pegawai()
    {
        $pegawai = DB::table('jabatan')->join('pegawai', 'pegawai.id_jabatan', '=', 'jabatan.id')->get();
        $jabatan =DB::table('jabatan')->select('id','nm_jabatan')->get();

        return view('pegawai', ['pegawai' => $pegawai, 'jabatan' => $jabatan]);
    }

    public function simpanpegawai(Request $request)
    {
        $created_at = date("Y-m-d H:i:s");
        $simpan = DB::table('pegawai')->insert([
            'nip' => $request->post('nip'),
            'nama' => $request->post('nama'),
            'id_jabatan' => $request->post('jabatan'),
            'no_telp' => $request->post('no_telp'),
            'created_at' => $created_at,
            'updated_at' => $created_at,
            'created_by' => $request->created,
        ]);
        if ($simpan) {
            Session::flash('sukses', 'Data berhasil disimpan.');
        } else {
            Session::flash('sukses', 'Data gagal disimpan.');
        }
        return redirect('pegawai');
    }

    public function editpegawai(Request $request)
    {
        $data = Pegawai::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function updatepegawai(Request $request)

    {
        $updated_at = date("Y-m-d H:i:s");
        $data = array(
            'nip' => $request->post('nip'),
            'nama' => $request->post('nama'),
            'id_jabatan' => $request->post('jabatan'),
            'no_telp' => $request->post('no_telp'),
            'updated_at' => $updated_at,
            'updated_by' => $request->updated,
        );
        $simpan = DB::table('pegawai')->where('id', '=', $request->post('id'))->update($data);
        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('pegawai')->with("sukses", "Data berhasil diubah");
    }

    public function hapuspegawai($id)
    {
        // hapus jabatan berdasarkan id yang dipilih
        DB::table('pegawai')->where('id', $id)->delete();

        return redirect('pegawai')->with("sukses", "Data berhasil dihapus");
    }
}