<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\View\View;


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

    public function hapusjabatan($id)
    {
        // hapus jabatan berdasarkan id yang dipilih
        DB::table('jabatan')->where('id', $id)->delete();

        return redirect('jabatan')->with("sukses", "Data berhasil dihapus");
    }

    // public function edit($id)
    // {
    //     $admin = DB::table('users')->where('id', $id)->get();
    //     return view('edit', ['admin' => $admin]);
    // }
    public function update(Request $request)
    {
        $updated_at = date("Y-m-d H:i:s");
        DB::table('users')->where('id', $request->iduser)->update([
            'name' => $request->nameUbah,
            'email' => $request->emailUbah,
            'updated_at' => $updated_at,
            'updated_by' => $request->updated,
        ]);
        return redirect('/admin')->with('message', 'User berhasil diupdated!');
    }
    public function delete($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect('/admin');
    }

    public function destroy($id)
    {
        return dd($id);
    }
    public function jsonUbahUser(Request $Request)
    {
        $data = User::findOrFail($Request->get('id'));
        echo json_encode($data);
    }
    public function jsonDelete(Request $Request)
    {
        $datadel = User::findOrFail($Request->get('id'));
        echo json_encode($datadel);
    }
    // public function destroy($id)
    // {
    //     //delete post by ID
    //     User::where('id', $id)->delete();

    //     //return response
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data Post Berhasil Dihapus!.',
    //     ]); 
    // }
    public function de($datadel)
    {
        DB::table('users')->where('id', $datadel)->delete();

        return redirect('/admin');
    }
}
