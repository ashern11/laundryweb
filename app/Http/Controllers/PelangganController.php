<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use App\Pelanggan;
use App\Http\Requests;

class PelangganController extends Controller
{

    public function index()
    {
        return view('Pelanggan');
    }

    public function dataPelanggan(){
            $datapelanggan = Pelanggan::select('id_pelanggan', 'nama', 'alamat', 'telp')->get();
            return Datatables::of($datapelanggan)
            ->addColumn('action',function ($datapelanggan) {
                return '<button type="button" id="edit_modal" value="'.$datapelanggan->id_pelanggan.'" class="btn btn-primary waves-effect"><i class="glyphicon glyphicon-edit"></i> Edit</button>';
            })
            ->make(true);
    }

    protected function validator(array $data){
        $rules = [
                'nama' => 'required|string|max:255',
                'alamat' => 'required|min:3|max:255',
                'telp' => 'required|string|max:13'
                ];
        $messages = [
                'required' => ':attribute wajib di isi',
                'max'      => ':attribute terlalu panjang',
                ];
        return Validator::make($data, $rules, $messages);
    }

    public function insert(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {    
            return response()->json(['error' => $validator->errors()->all()]);
        }else{
            $Pelanggan = Pelanggan::create($request->all());
            return Response()->json(['success'=>'Berhasil Ditambahkan']);
        };
    }

    public function edit($id)
    {
        $Pelanggan = Pelanggan::find($id);
        return Response()->json($Pelanggan);
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {    
            return response()->json(['error' => $validator->errors()->all()]);
        }else{
            $Pelanggan = Pelanggan::find($id);
            $Pelanggan->nama = $request->nama;
            $Pelanggan->alamat = $request->alamat;
            $Pelanggan->telp = $request->telp;
            $Pelanggan->save();
            return Response()->json(['success'=>'Berhasil Diedit']);
        };
    }
}
