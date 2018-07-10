<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

use App\Transaksi;
use App\Transaksitmp;
use App\Transaksidetail;
use App\Jenislaundry;
use App\Pelanggan;
use App\Http\Requests;

class TransaksiController extends Controller
{

    public function index()
    {
        Transaksitmp::truncate();
        $date = date('d / m / Y');
        $pelanggan = Pelanggan::all(['id_pelanggan', 'nama', 'telp']);
        $jenislaundry = Jenislaundry::all(['id_jenis', 'jenis', 'satuan', 'harga']);
        $nota = $this->autonumber();
        return view('transaksi', compact('nota', 'date', 'pelanggan', 'jenislaundry', 'nota'));
    }

    public function dataTransaksi(){
        $transaksi = Transaksitmp::select('no', 'jenis_laundry.jenis', 'jumlah', 'total')
        ->join('jenis_laundry', 'jenis_laundry.id_jenis', '=', 'transaksi_tmp.id_jenis')
        ->get();
        return Datatables::of($transaksi)
        ->addColumn('action',function ($transaksi) {
            return '<button type="button" id="edit_modal" value="'.$transaksi->no.'" class="btn btn-primary waves-effect"><i class="material-icons">edit</i> Edit </button>
                    <button type="button" id="hapus_cucian" value="'.$transaksi->no.'" class="btn btn-primary waves-effect"><i class="material-icons">delete</i> Hapus </button>';
        })
        ->make(true);
    }


    public function autonumber(){
        $date = date('dmy');
        $q = DB::table('transaksi')->select(DB::raw('MAX(RIGHT(tm_nota, 3)) AS kd_max'))->where(DB::raw('LEFT(tm_nota, 6)'), '=', $date);
        dd($q);
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = $date.sprintf("%03s", $tmp);
            }
        }
        else
        {
            $kd = $date."001";
        }

        return $kd;
    }

    public function tambah(Request $request)
    {
        $cektransaksitmp = Transaksitmp::select('no', 'id_jenis', 'jumlah')->where('id_jenis', $request->id_jenis)->get();
        if(count($cektransaksitmp)>0){
                $transaksitmp = Transaksitmp::find($cektransaksitmp[0]['no']);
                $transaksitmp->jumlah = $cektransaksitmp[0]['jumlah'] + $request->jumlah;
                $transaksitmp->save();
        }else{
            $transaksitmp = Transaksitmp::create($request->all());
        }
        return Response()->json($transaksitmp);
    }


    public function edit($id)
    {
        $transaksitmp = Transaksitmp::find($id);
        return Response()->json($transaksitmp);
    }

    public function update(Request $request, $id)
    {
        $transaksitmp = Transaksitmp::find($id);
        $transaksitmp->jumlah = $request->jumlah;
        $transaksitmp->save();

        return Response()->json($transaksitmp);
    }

    public function simpan(Request $request)
    {
        $total = Transaksitmp::select(DB::raw('SUM(total) as total'))->get();

        $simpan = Transaksi::insert([
            'tm_nota' => $request->tm_nota,
            'id_user' =>  $request->id_user,
            'id_pelanggan' => $request->id_pelanggan,
            'tm_total' => $total[0]['total'],
            'bayar' => 0,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
            ]);
        $data = Transaksitmp::select('tm_nota', 'id_jenis', 'jumlah')->get();
        foreach($data as $k){
        Transaksidetail::insert([
                'tm_nota' => $k['tm_nota'],
                'id_jenis' => $k['id_jenis'],
                'jumlah' => $k['jumlah'],
                'total' => null,
                ]);
        }
        Transaksitmp::truncate();
        return Response()->json($simpan);
    }

    public function destroy($id)
    {
        $transaksitmp = Transaksitmp::where('no', '=', $id)->delete();
        return Response()->json($transaksitmp);
    }

}
