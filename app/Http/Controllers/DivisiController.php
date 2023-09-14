<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\divisi;

class DivisiController extends Controller
{
    
    public function divisi(): View
    {
        $divisi = DB::table('divisi')->paginate(5);

        return view('divisi', ['divisi' => $divisi]);
    }
    public function simpandivisi(Request $request)
    {
        $simpan = DB::table('divisi')->insert([
            'Nama_divisi' => $request->post('nama'),
        ]);
        if ($simpan) {
            Session::flash('sukses', 'Data berhasil disimpan.');
        } else {
            Session::flash('sukses', 'Data gagal disimpan.');
        }
        return redirect('divisi');
        
    }
    public function hapusdivisi($id)
    {
        // hapus divisi berdasarkan id yang dipilih
        DB::table('divisi')->where('id', $id)->delete();

        return redirect('divisi')->with("sukses", " berhasil dihapus");
    }
    public function editdivisi(Request $request)
    {
        $data = divisi::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function updatedivisi(Request $request)

    {
        $data = array(
            'nama_divisi' => $request->post('nama'),
        );
        $simpan = DB::table('divisi')->where('id', '=', $request->post('id'))->update($data);
        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('divisi')->with("sukses", "berhasil diubah");
    }



}
