<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaksi;
use App\Http\Requests;
use Yajra\Datatables\Datatables;

class laporanController extends Controller
{
	    public function index()
    {
        return view('laporan');
    }

    public function dataBelumLunas(){
        $transaksi = Transaksi::select('tm_nota', 'admin.nama_lengkap', 'pelanggan.nama', 'tm_total', 'transaksi.created_at')
        ->join('admin', 'admin.id_user', '=', 'transaksi.id_user')
        ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'transaksi.id_pelanggan')
        ->where('transaksi.bayar', '=', '0')
        ->get();
        return Datatables::of($transaksi)
        ->make(true);
	}

	    public function dataLunas(){
        $transaksi = Transaksi::select('tm_nota', 'admin.nama_lengkap', 'pelanggan.nama', 'tm_total', 'transaksi.created_at')
        ->join('admin', 'admin.id_user', '=', 'transaksi.id_user')
        ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'transaksi.id_pelanggan')
        ->where('transaksi.bayar', '=', '1')
        ->get();
        return Datatables::of($transaksi)
        ->make(true);
		}



}
