<?php

namespace App\Http\Controllers\Category;

use App\CatKendaraan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class CatKendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = CatKendaraan::all()->pluck('kendaraan_nama','id');

        return view('category.index', compact('kendaraan'));
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = CatKendaraan::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('waktu', function($data){
                        $waktu = $data->created_at->format('D, d M y');
                        return $waktu;
                        })
                    ->addColumn('action', function($data){
                         $action = '<button type="button" id="deleteKendaraan" data-id="'.$data->id.'" class="delete btn btn-danger btn-xs"><i class="fa fa-eraser"></i></button>';
                         return $action;
                         })
                    // ->addColumn('image', 'image')
                    ->rawColumns(['action','waktu'])
                    ->make(true);
        }
        return view('category.index');
    }

    public function store(Request $request)
    {
        foreach($request->nama_kendaraan as $key => $value) {
            $nilai = [
                'kendaraan_nama' =>  Str::upper($request->nama_kendaraan[$key]),
            ];
            $data = CatKendaraan::create($nilai);
        }

        return response()->json($data);
    }

    public function destroy($id)
    {
        CatKendaraan::where('id',$id)->delete();
        return response()->json(['success'=>'Item deleted successfully.']);
    }

}
