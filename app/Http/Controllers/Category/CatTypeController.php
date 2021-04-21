<?php

namespace App\Http\Controllers\Category;

use App\CatType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CatTypeController extends Controller
{
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = CatType::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('waktu', function($data){
                        $waktu = $data->created_at->format('D, d M y');
                        return $waktu;
                        })
                    ->editColumn('kendaraan', function($data){
                        $type = $data->kendaraan->kendaraan_nama;
                        return $type;
                    })
                    ->addColumn('action', function($data){
                         $action = '<button type="button" id="deleteType" data-id="'.$data->id.'" class="delete btn btn-danger btn-xs"><i class="fa fa-eraser"></i></button>';
                         return $action;
                         })
                    // ->addColumn('image', 'image')
                    ->rawColumns(['action','kendaraan'])
                    ->make(true);
        }
        return view('category.index');
    }

    public function store(Request $request)
    {
        foreach($request->nama_type as $key => $value) {
            $nilai = [
                'kendaraan_id' =>  $request->id_kendaraan1,
                'type_nama' =>  Str::upper($request->nama_type[$key]),
            ];
            $data = CatType::create($nilai);
        }

        return response()->json($data);
    }

    public function destroy($id)
    {
        CatType::where('id',$id)->delete();
        return response()->json(['success'=>'Item deleted successfully.']);
    }

    public function selectType($id)
    {
        $type = CatType::where('kendaraan_id', $id)->pluck('type_nama','id');
        return json_encode($type);
    }
}
