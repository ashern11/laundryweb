<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use App\Jenislaundry;
use App\Http\Requests;

class JenislaundryController extends Controller
{

    public function index()
    {
        return view('jenislaundry');
    }

    public function dataJenislaundry(){
            $jenislaundry = Jenislaundry::select('id_jenis', 'jenis', 'satuan', 'harga')->get();
            return Datatables::of($jenislaundry)
            ->addColumn('action',function ($jenislaundry) {
                return '<button type="button" id="edit_modal" value="'.$jenislaundry->id_jenis.'" class="btn btn-primary waves-effect"><i class="glyphicon glyphicon-edit"></i> Edit</button>';
            })
            ->make(true);
    }


    
    protected function validator(array $data){
        $rules = [
                'jenis' => 'required|string|max:30',
                'satuan' => 'required|max:30',
                'harga' => 'required|integer'
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
            $jenislaundry = Jenislaundry::create($request->all());
            return Response()->json(['success'=>'Berhasil Ditambahkan']);
        };
    }


    public function edit($id)
    {
        $jenislaundry = Jenislaundry::find($id);
        return Response()->json($jenislaundry);
    }


    public function update(Request $request, $id)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {    
            return response()->json(['error' => $validator->errors()->all()]);
        }else{
            $jenislaundry = Jenislaundry::find($id);
            $jenislaundry->jenis = $request->jenis;
            $jenislaundry->satuan = $request->satuan;
            $jenislaundry->harga = $request->harga;
            $jenislaundry->save();
            return Response()->json(['success'=>'Berhasil Diedit']);
        };
    }


    public function destroy($id)
    {
        //
    }
}
