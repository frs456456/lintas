<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Models\Jabatan;


class JabatanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function jabatan(): View
    {
        $jabatan = DB::table('jabatan')->paginate(5);

        return view('jabatan', ['jabatan' => $jabatan]);
    }

    // public function tambah()
    // {
    //     return view('tambah');
    // }
    public function simpanjabatan(Request $request)
    {
        $simpan = DB::table('jabatan')->insert([
            'nm_jabatan' => $request->post('nm_jabatan'),
        ]);
        if ($simpan) {
            Session::flash('sukses', 'Data berhasil disimpan.');
        } else {
            Session::flash('sukses', 'Data gagal disimpan.');
        }
        return redirect('jabatan');
    }

    public function editjabatan(Request $request)
    {
        $data = Jabatan::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function updatejabatan(Request $request)

    {
        $data = array(
            'nm_jabatan' => $request->post('nama'),
        );
        $simpan = DB::table('jabatan')->where('id', '=', $request->post('id'))->update($data);
        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('jabatan')->with("sukses", "Data berhasil diubah");
    }

    public function hapusjabatan($id)
    {
        // hapus jabatan berdasarkan id yang dipilih
        DB::table('jabatan')->where('id', $id)->delete();

        return redirect('jabatan')->with("sukses", "Data berhasil dihapus");
    }
}
