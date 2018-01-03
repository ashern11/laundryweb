<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaksi;
use App\Transaksidetail;
use Yajra\Datatables\Datatables;

class CetaknotaController extends Controller
{
    public function index($id)
    {
        $nota = $id;
        $date = date('d / m / Y');
        $query = Transaksi::select('tm_nota', 'admin.nama_lengkap', 'pelanggan.nama', 'tm_total', 'transaksi.created_at', 'transaksi.updated_at')
        ->join('admin', 'admin.id_user', '=', 'transaksi.id_user')
        ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'transaksi.id_pelanggan')
        ->where('tm_nota', $id)
        ->where('tm_nota', $id);
        if($query->count() > 0){
            foreach ($query->get() as $key) {
                $nama_lengkap = $key->nama_lengkap;
                $nama = $key->nama;
                $total = $key->tm_total;
            }
        }else{
            $nama_lengkap = null;
            $nama = null;
            $total = null;
         
        };
        $this->dataCucian($id);
        return view('cetaknota', compact('nama_lengkap', 'nama','total', 'nota', 'date'));
    }

    public function dataCucian($id){
            $cucian = Transaksidetail::select('jenis','jumlah','satuan', 'total')
            ->join('jenis_laundry', 'jenis_laundry.id_jenis', '=', 'transaksi_detail.id_jenis')
            ->where('transaksi_detail.tm_nota', '=', $id)
            ->get();
        return Datatables::of($cucian)
        ->make(true);
    }
}


