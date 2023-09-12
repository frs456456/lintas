<?php

namespace App\Http\Controllers;

use App\Models\Handphone;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\Inventaris;
use App\Models\Maintenance;
use App\Models\Peminjaman;
use App\Models\Kendaraan_satpam;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // //REMINDER SERVIS

        // $digunakan = Handphone::where('status', '=', '2')->count();
        // $belumdigunakan = Handphone::where('status','=', '1')->count();
        // $notifDiajukan = Peminjaman::where('status','=','1')->count();
        // $peminjamanBerlangsung = Peminjaman::where('status', '=', '2')->count();
        // $statusSatpamKeluar = Kendaraan_satpam::where('status', '=', '1')->count();
        // $peminjamanSelesai = Peminjaman::where('status', '=', '3')->count();
        // $kendaraan_tersedia =
        // Kendaraan::where('id', '!=', 5)->where('status', '=', '1')->count();
        // $total_kendaraan = Kendaraan::all()->count();
        // $kendaraan_booking = Kendaraan::where('status','=','3')->count();

        // $record_peminjaman_jan = Peminjaman::where('status','=','3')->whereMonth('tanggal','=','01')->whereYear('tanggal','=',date('Y'))->count();
        // $record_peminjaman_feb = Peminjaman::where('status', '=', '3')->whereMonth('tanggal', '=', '02')->whereYear('tanggal', '=', date('Y'))->count();
        // $record_peminjaman_mar = Peminjaman::where('status', '=', '3')->whereMonth('tanggal', '=', '03')->whereYear('tanggal', '=', date('Y'))->count();
        // $record_peminjaman_apr = Peminjaman::where('status', '=', '3')->whereMonth('tanggal', '=', '04')->whereYear('tanggal', '=', date('Y'))->count();
        // $record_peminjaman_mei = Peminjaman::where('status', '=', '3')->whereMonth('tanggal', '=', '05')->whereYear('tanggal', '=', date('Y'))->count();
        // $record_peminjaman_jun = Peminjaman::where('status', '=', '3')->whereMonth('tanggal', '=', '06')->whereYear('tanggal', '=', date('Y'))->count();
        // $record_peminjaman_jul = Peminjaman::where('status', '=', '3')->whereMonth('tanggal', '=', '07')->whereYear('tanggal', '=', date('Y'))->count();
        // $record_peminjaman_ags = Peminjaman::where('status', '=', '3')->whereMonth('tanggal', '=', '08')->whereYear('tanggal', '=', date('Y'))->count();
        // $record_peminjaman_sep = Peminjaman::where('status', '=', '3')->whereMonth('tanggal', '=', '09')->whereYear('tanggal', '=', date('Y'))->count();
        // $record_peminjaman_okt = Peminjaman::where('status', '=', '3')->whereMonth('tanggal', '=', '10')->whereYear('tanggal', '=', date('Y'))->count();
        // $record_peminjaman_nov = Peminjaman::where('status', '=', '3')->whereMonth('tanggal', '=', '11')->whereYear('tanggal', '=', date('Y'))->count();
        // $record_peminjaman_des = Peminjaman::where('status', '=', '3')->whereMonth('tanggal', '=', '12')->whereYear('tanggal', '=', date('Y'))->count();

        // View::share(['digunakan'=> $digunakan,'belumdigunakan'=> $belumdigunakan, 'notifDiajukan'=> $notifDiajukan, 'kendaraan_tersedia'=> $kendaraan_tersedia, 'total_kendaraan'=> $total_kendaraan, 'peminjamanBerlangsung'=> $peminjamanBerlangsung, 'peminjamanSelesai'=> $peminjamanSelesai, 'record_peminjaman_jan' => $record_peminjaman_jan, 'record_peminjaman_feb' => $record_peminjaman_feb, 'record_peminjaman_mar'=> $record_peminjaman_mar, 'record_peminjaman_apr'=> $record_peminjaman_apr, 'record_peminjaman_mei'=> $record_peminjaman_mei, 'record_peminjaman_jun'=> $record_peminjaman_jun, 'record_peminjaman_jul'=> $record_peminjaman_jul, 'record_peminjaman_ags'=> $record_peminjaman_ags, 'record_peminjaman_sep'=> $record_peminjaman_sep, 'record_peminjaman_okt'=> $record_peminjaman_okt, 'record_peminjaman_nov'=> $record_peminjaman_nov, 'record_peminjaman_des'=> $record_peminjaman_des, 'statusSatpamKeluar' => $statusSatpamKeluar, 'kendaraan_booking'=> $kendaraan_booking]);

    }
}
