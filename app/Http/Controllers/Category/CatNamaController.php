<?php

namespace App\Http\Controllers\Category;

use App\CatNama;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CatNamaController extends Controller
{
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = CatNama::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('waktu', function($data){
                        $waktu = $data->created_at->format('d, M Y');;
                        return $waktu;
                        })
                    ->editColumn('kendaraan', function($data){
                        $kendaraan = $data->kendaraan->kendaraan_nama;
                        return $kendaraan;
                    })
                    ->editColumn('type', function($data){
                        $type = $data->type->type_nama;
                        return $type;
                    })
                    ->addColumn('action', function($data){
                         $action = '<button type="button" id="deleteNama" data-id="'.$data->id.'" class="delete btn btn-danger btn-xs"><i class="fa fa-eraser"></i></button>';
                         return $action;
                         })
                    // ->addColumn('image', 'image')
                    ->rawColumns(['action','kendaraan','type'])
                    ->make(true);
        }
        return view('category.index');
    }

    public function store(Request $request)
    {
        foreach($request->nama_ban as $key => $value) {
            $nilai = [
                'kendaraan_id' =>  $request->id_kendaraan,
                'type_id' =>  $request->id_type,
                'ban_nama' => Str::upper($request->nama_ban[$key]),
            ];
            $data = CatNama::create($nilai);
        }

        return response()->json($data);
    }

    public function destroy($id)
    {
        CatNama::where('id',$id)->delete();
        return response()->json(['success'=>'Item deleted successfully.']);
    }

    public function selectNama($id)
    {
        $nama = CatNama::where('type_id', $id)->pluck('ban_nama','id');
        return json_encode($nama);
    }
}
