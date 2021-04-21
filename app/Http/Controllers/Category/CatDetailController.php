<?php

namespace App\Http\Controllers\Category;

use App\CatDetail;
use App\CatNama;
use App\Http\Controllers\Controller;
use App\StockDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class CatDetailController extends Controller
{
    public function show(){
        return view('category.show');

    }
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = CatDetail::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('kendaraan', function($data){
                        $kendaraan = $data->kendaraan->kendaraan_nama;
                        return $kendaraan;
                    })
                    ->editColumn('type', function($data){
                        $type = $data->type->type_nama;
                        return $type;
                    })
                    ->editColumn('nama', function($data){
                        $nama = $data->nama->ban_nama;
                        return $nama;
                    })
                    ->editColumn('harga', function($data){
                        $harga = 'Rp'.number_format($data->harga,2) ;
                        return $harga;
                    })
                    ->editColumn('rim', function($data){
                        if (!$data->rim) {
                            $rim = '<i>Null</i>';
                        }else{
                            $rim = $data->rim;
                        }
                        return $rim;
                    })
                    ->editColumn('pelek', function($data){
                        if (!$data->pelek) {
                            $pelek = '<i>Null</i>';
                        }else{
                            $pelek = $data->pelek;
                        }
                        return $pelek;
                    })
                    ->editColumn('tipe', function($data){
                        if (!$data->tipe) {
                            $tipe = '<i>Null</i>';
                        }else{
                            $tipe = $data->tipe;
                        }
                        return $tipe;
                    })
                    ->editColumn('ply', function($data){
                        if (!$data->ply) {
                            $ply = '<i>Null</i>';
                        }else{
                            $ply = $data->ply;
                        }
                        return $ply;
                    })
                    ->addColumn('action', function($data){
                         $action = '<button type="button" id="deleteDetail" data-id="'.$data->id.'" class="delete btn btn-danger btn-xs"><i class="fa fa-eraser"></i></button>';
                         return $action;
                         })
                    // ->addColumn('image', 'image')
                    ->rawColumns(['action','kendaraan','type','nama','harga','rim','tipe','pelek','ply'])
                    ->make(true);
        }
        return view('category.index');
    }

    public function store(Request $request)
    {
        $id_user = Auth::user()->id;

        foreach($request->ukuran as $key => $value) {
            $nilai = [
                'user_id' =>  $id_user,
                'kendaraan_id' =>  $request->id_kendaraan2,
                'type_id' =>  $request->id_type2,
                'nama_id' =>  $request->id_nama_ban,
                'ukuran_ban' =>  Str::upper($request->ukuran[$key]) ,
                'stock' =>  $request->stock[$key],
                'harga' => str_replace(',','',$request->harga[$key]),
                'rim' =>  Str::upper($request->rim[$key]) ,
                'pelek' =>  $request->pelek[$key],
                'tipe' =>  Str::upper($request->tipe[$key]),
                'ply' =>  Str::upper($request->ply[$key]),
            ];
            $data = CatDetail::create($nilai);

            $stock = [
                'user_id' => $id_user,
                'detail_id' => $data->id,
                'stock_input' => $request->stock[$key],
                'status' => 'Stock Di Input',
            ];
            StockDetail::create($stock);
        }

        return response()->json($data);
    }

    public function destroy($id)
    {
        CatDetail::where('id',$id)->delete();
        return response()->json(['success'=>'Item deleted successfully.']);
    }
}
