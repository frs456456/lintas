<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\barang;

class BarangController extends Controller
{
    
    public function barang(): View
    {
        $barang = DB::table('barang')->paginate(5);

        return view('barang', ['barang' => $barang]);
    }
    public function simpanbarang(Request $request)
    {
        $file = $request->file('file');

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'img';
        $nama_file = time() . "_" . $file->getClientOriginalName();

        // upload file
        $file->move($tujuan_upload, $nama_file);
        $created_at = date("Y-m-d H:i:s");
        DB::table('barang')->insert([
            'nama' => $request->nama,
            'image' => $nama_file,
            'qty'=> $request->qty,
            'created_at' => $created_at,
            'updated_at' => $created_at,
            'created_by' => $request->created,
                     
        ]);
        return redirect('/barang')->with('message', 'User berhasil ditambahkan!');
        
    }
    
    public function hapusbarang($id)
    {
        // hapus barang berdasarkan id yang dipilih
        DB::table('barang')->where('id', $id)->delete();

        return redirect('barang')->with("sukses", " berhasil dihapus");
    }
    public function editbarang(Request $request)
    {
        $data = barang::findOrFail($request->get('id'));
        echo json_encode($data);
    }

    public function updatebarang(Request $request)

    {
        $file = $request->file('file');

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'img';
        $nama_file = time() . "_" . $file->getClientOriginalName();

        // upload file
        $file->move($tujuan_upload, $nama_file);
        $data = array(
            'nama' => $request->post('nama'),
            'image'=> $nama_file,
            'qty' => $request->post('qty'),
        );
        $simpan = DB::table('barang')->where('id', '=', $request->post('id'))->update($data);
        if ($simpan) {
            Session::flash('status', 'Data berhasil diupdate.');
        } else {
            Session::flash('status', 'Data gagal diupdate.');
        }
        return redirect('barang')->with("sukses", "berhasil diubah");
    }


}
