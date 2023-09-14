<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DivisiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\File;
use Matrix\Operators\Division;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::get('/register', [HomeController::class, 'register'])->name('register');

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::get('/pegawai', [HomeController::class, 'pegawai'])->name('pegawai');
Route::POST('/simpan_pegawai', [HomeController::class, 'simpan_pegawai'])->name('simpan_pegawai');
Route::get('/edit_pegawai', [HomeController::class, 'edit_pegawai'])->name('edit_pegawai');
Route::POST('/update_pegawai', [HomeController::class, 'update_pegawai'])->name('update_pegawai');
Route::get('/pegawai/hapus/{id}', [HomeController::class, 'pegawai_hapus'])->name('pegawai_hapus');

Route::get('/kendaraan', [HomeController::class, 'kendaraan'])->name('kendaraan');
Route::POST('/simpan_kendaraan', [HomeController::class, 'simpan_kendaraan'])->name('simpan_kendaraan');
Route::get('/edit_kendaraan', [HomeController::class, 'edit_kendaraan'])->name('edit_kendaraan');
Route::get('/edit_last_servis', [HomeController::class, 'edit_last_servis'])->name('edit_last_servis');
Route::POST('/update_kendaraan', [HomeController::class, 'update_kendaraan'])->name('update_kendaraan');
Route::POST('/update_last_servis', [HomeController::class, 'update_last_servis'])->name('update_last_servis');
Route::get('/kendaraan/hapus/{id}', [HomeController::class, 'kendaraan_hapus'])->name('kendaraan_hapus');
Route::get('/edit_ketersediaan', [HomeController::class, 'edit_ketersediaan'])->name('edit_ketersediaan');
Route::POST('/update_ketersediaan', [HomeController::class, 'update_ketersediaan'])->name('update_ketersediaan');

Route::get('/peminjaman', [HomeController::class, 'peminjaman'])->name('peminjaman');
Route::POST('/simpan_peminjaman', [HomeController::class, 'simpan_peminjaman'])->name('simpan_peminjaman');
Route::POST('/simpan_booking', [HomeController::class, 'simpan_booking'])->name('simpan_booking');
Route::get('/edit_peminjaman_booking', [HomeController::class, 'edit_peminjaman_booking'])->name('edit_peminjaman_booking');
Route::POST('/update_booking', [HomeController::class, 'update_booking'])->name('update_booking');
Route::get('/peminjaman/hapusbooking/{id}', [HomeController::class, 'peminjaman_hapusbooking'])->name('peminjaman_hapusbooking');
Route::get('/pengajuan/hapusbooking/{id}', [HomeController::class, 'pengajuan_hapusbooking'])->name('pengajuan_hapusbooking');

Route::get('/edit_peminjaman', [HomeController::class, 'edit_peminjaman'])->name('edit_peminjaman');
Route::POST('/update_peminjaman', [HomeController::class, 'update_peminjaman'])->name('update_peminjaman');
Route::get('/peminjaman/hapus/{id}', [HomeController::class, 'peminjaman_hapus'])->name('peminjaman_hapus');
Route::get('/edit_peminjaman_selesai', [HomeController::class, 'edit_peminjaman_selesai'])->name('edit_peminjaman_selesai');
Route::POST('/update_selesai', [HomeController::class, 'update_selesai'])->name('update_selesai');
Route::POST('/update_validasifotoawal', [HomeController::class, 'update_validasifotoawal'])->name('update_validasifotoawal');
Route::POST('/update_terima', [HomeController::class, 'update_terima'])->name('update_terima');

Route::get('/pengajuan', [HomeController::class, 'pengajuan'])->name('pengajuan');
Route::POST('/simpan_pengajuan', [HomeController::class, 'simpan_pengajuan'])->name('simpan_pengajuan');
Route::get('/edit_pengajuan', [HomeController::class, 'edit_pengajuan'])->name('edit_pengajuan');
Route::get('/tolak_pengajuan', [HomeController::class, 'tolak_pengajuan'])->name('tolak_pengajuan');
Route::POST('/update_tolak_pengajuan', [HomeController::class, 'update_tolak_pengajuan'])->name('update_tolak_pengajuan');
Route::get('/lihat_keterangan', [HomeController::class, 'lihat_keterangan'])->name('lihat_keterangan');
Route::POST('/update_pengajuan', [HomeController::class, 'update_pengajuan'])->name('update_pengajuan');
Route::get('/pengajuan/hapus/{id}', [HomeController::class, 'pengajuan_hapus'])->name('pengajuan_hapus');
Route::get('/pengajuan/verif_spv/{id}', [HomeController::class, 'pengajuan_verif_spv'])->name('pengajuan_verif_spv');
Route::get('/pengajuan/verif_spv_booking/{id}', [HomeController::class, 'pengajuan_verif_spv_booking'])->name('pengajuan_verif_spv_booking');

Route::get('/edit_terima', [HomeController::class, 'edit_terima'])->name('edit_terima');
Route::get('/edit_terima_booking', [HomeController::class, 'edit_terima_booking'])->name('edit_terima_booking');
Route::POST('/update_terima_booking', [HomeController::class, 'update_terima_booking'])->name('update_terima_booking');

Route::get('/surat_jalan{id}', [HomeController::class, 'surat_jalan'])->name('surat_jalan');
Route::get('/detail_peminjaman{id}', [HomeController::class, 'detail_peminjaman'])->name('detail_peminjaman');

Route::get('/tamu', [HomeController::class, 'tamu'])->name('tamu');
Route::POST('/simpan_tamu', [HomeController::class, 'simpan_tamu'])->name('simpan_tamu');
Route::get('/edit_tamu', [HomeController::class, 'edit_tamu'])->name('edit_tamu');
Route::POST('/update_tamu', [HomeController::class, 'update_tamu'])->name('update_tamu');
Route::get('/tamu/hapus/{id}', [HomeController::class, 'tamu_hapus'])->name('tamu_hapus');
Route::get('/tamu/keluar/{id}', [HomeController::class, 'tamu_keluar'])->name('tamu_keluar');
Route::get('/detail_tamu{id}', [HomeController::class, 'detail_tamu'])->name('detail_tamu');
Route::POST('/tambah_ajax', [HomeController::class, 'tambah_ajax'])->name('tambah_ajax');
Route::get('/tamu_tambah', [HomeController::class, 'tamu_tambah'])->name('tamu_tambah');

Route::get('/user', [HomeController::class, 'user'])->name('user');
Route::POST('/simpan_user', [HomeController::class, 'simpan_user'])->name('simpan_user');
Route::get('/edit_user', [HomeController::class, 'edit_user'])->name('edit_user');
Route::POST('/update_user', [HomeController::class, 'update_user'])->name('update_user');
Route::get('/user/hapus/{id}', [HomeController::class, 'user_hapus'])->name('user_hapus');

Route::get('/gpass', [HomeController::class, 'gpass'])->name('gpass');
Route::POST('/simpan_gpass', [HomeController::class, 'simpan_gpass'])->name('simpan_gpass');
Route::get('/edit_gpass', [HomeController::class, 'edit_gpass'])->name('edit_gpass');
Route::POST('/update_gpass', [HomeController::class, 'update_gpass'])->name('update_gpass');
Route::get('/gpass/hapus/{id}', [HomeController::class, 'gpass_hapus'])->name('gpass_hapus');

Route::get('/kendaraanSatpam', [HomeController::class, 'kendaraanSatpam'])->name('kendaraanSatpam');
Route::POST('/simpan_kendaraanSatpam', [HomeController::class, 'simpan_kendaraanSatpam'])->name('simpan_kendaraanSatpam');
Route::get('/edit_kendaraanSatpam', [HomeController::class, 'edit_kendaraanSatpam'])->name('edit_kendaraanSatpam');
Route::POST('/update_kendaraanSatpam', [HomeController::class, 'update_kendaraanSatpam'])->name('update_kendaraanSatpam');
Route::get('/kendaraanSatpam/hapus/{id}', [HomeController::class, 'kendaraanSatpam_hapus'])->name('kendaraanSatpam_hapus');
Route::get('/kendaraanSatpam/keluar/{id}', [HomeController::class, 'kendaraanSatpam_keluar'])->name('kendaraanSatpam_keluar');
Route::get('/kendaraanSatpam/kembali/{id}', [HomeController::class, 'kendaraanSatpam_kembali'])->name('kendaraanSatpam_kembali');
Route::get('/kendaraanSatpam/keluar/{id}/Sekper/TI/Tirtaasasta', [HomeController::class, 'kendaraanSatpam_keluar_qrcode'])->name('kendaraanSatpam_keluar_qrcode');

Route::get('/kendaraanSatpamdetail{id}SekperTITirtaasasta', [HomeController::class, 'kendaraanSatpam_detail_qrcode'])->name('kendaraanSatpam_detail_qrcode');

Route::get('/laporan_peminjaman', [HomeController::class, 'laporan_peminjaman'])->name('laporan_peminjaman');
Route::get('/laporanhasil', [HomeController::class, 'laporan_hasil'])->name('laporan_hasil');


Route::get('/kategori', [HomeController::class, 'kategori'])->name('kategori');
Route::POST('/simpankategori', [HomeController::class, 'simpankategori'])->name('simpankategori');
Route::get('/editkategori', [HomeController::class, 'editkategori'])->name('editkategori');
Route::POST('/updatekategori', [HomeController::class, 'updatekategori'])->name('updatekategori');
Route::get('/hapuskategori/{id}', [HomeController::class, 'hapuskategori'])->name('hapuskategori');

Route::get('/arsip', [HomeController::class, 'arsip'])->name('arsip');
Route::POST('/cariarsip', [HomeController::class, 'arsip'])->name('arsip');
Route::POST('/simpanarsip', [HomeController::class, 'simpanarsip'])->name('simpanarsip');
Route::get('/editarsip', [HomeController::class, 'editarsip'])->name('editarsip');
Route::POST('/updatearsip', [HomeController::class, 'updatearsip'])->name('updatearsip');
Route::get('/hapusarsip/{id}', [HomeController::class, 'hapusarsip'])->name('hapusarsip');

Route::get('/divisi', [DivisiController::class, 'divisi'])->name('divisi');
Route::POST('/simpandivisi', [DivisiController::class, 'simpandivisi'])->name('simpandivisi');
Route::get('/hapusdivisi/{id}', [DivisiController::class, 'hapusdivisi'])->name('hapusdivisi');
Route::get('/editdivisi', [DivisiController::class, 'editdivisi'])->name('editdivisi');
Route::POST('/updatedivisi', [DivisiController::class, 'updatedivisi'])->name('updatedivisi');
Route::get('/barang', [BarangController::class, 'barang'])->name('barang');
Route::POST('/simpanbarang', [BarangController::class, 'simpanbarang'])->name('simpanbarang');
Route::get('/hapusdivisi/{id}', [DivisiController::class, 'hapusdivisi'])->name('hapusdivisi');
Route::get('/hapusbarang/{id}', [BarangController::class, 'hapusbarang'])->name('hapusdivisi');
Route::get('/editbarang', [BarangController::class, 'editbarang'])->name('editbarang');
Route::POST('/updatebarang', [BarangController::class, 'updatebarang'])->name('updatebarang');







// $filesInFolder = File::files(resource_path('views'));
// foreach ($filesInFolder as $path) {
//     $file = pathinfo($path);
//     $explode = explode('.blade', $file['filename']);
//     foreach ($explode as $ex) {
//         Route::get('/' . $ex, [HomeController::class, $ex])->name($ex);
//         Route::POST('/simpan_' . $ex, [HomeController::class, 'simpan_pegawai'])->name('simpan_pegawai');
//         Route::get('/edit_' . $ex, [HomeController::class, 'edit_pegawai'])->name('edit_pegawai');
//         Route::POST('/update_' . $ex, [HomeController::class, 'update_pegawai'])->name('update_pegawai');
//         Route::get('/' . $ex . '/hapus/{id}', [HomeController::class, 'pegawai_hapus'])->name('pegawai_hapus');
//     }
// }
