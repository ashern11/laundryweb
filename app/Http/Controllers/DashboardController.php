<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use App\Transaksi;
use App\User;
use App\Transaksidetail;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('index');
    }

    public function dataTransaksi(){
            $transaksi = Transaksi::select('tm_nota', 'admin.nama_lengkap', 'pelanggan.nama', 'tm_total', 'transaksi.created_at')
            ->join('admin', 'admin.id_user', '=', 'transaksi.id_user')
            ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'transaksi.id_pelanggan')
            ->where('transaksi.bayar', '=', '0')
            ->get();
            return Datatables::of($transaksi)
            ->addColumn('action',function ($transaksi) {
                return '<button type="button" id="edit_modal" value="'.$transaksi->tm_nota.'" class="btn btn-primary waves-effect"><i class="glyphicon glyphicon-edit"></i> Bayar </button>';
            })
            ->make(true);
    }

    public function detailCucian($id){
        $cucian = Transaksidetail::select('jenis','jumlah','satuan', 'total')
                    ->join('jenis_laundry', 'jenis_laundry.id_jenis', '=', 'transaksi_detail.id_jenis')
                    ->where('transaksi_detail.tm_nota', '=', $id)
                    ->get();
        return Datatables::of($cucian)
        ->make(true);
    }


    public function bayar($id)
    {
        $data = Transaksi::find($id);
        $data->bayar = 1;
        $data->save();
        return Response()->json($data);
    }

    public function ubah(Request $request){
        $user = Auth::user();

        $curPassword = $request->Passwordlama;
        $newPassword = $request->Passwordbaru;

        if (Hash::check($curPassword, $user->sandi)) {
            $obj_user = User::find($user->id_user);
            $obj_user->sandi = Hash::make($newPassword);
            $obj_user->save();

            return response()->json(["pesan"=>"Passwod Berhasil Diubah", "warna"=>"bg-cyan"]);
        }
        else
        {
            return response()->json(["pesan"=>"Password Lama Salah","warna"=>"bg-red"]);
        }
    }

}
