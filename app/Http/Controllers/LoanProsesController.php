<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

use App\staf;

use App\BanKendaraan;
use App\Loan;
use App\BanType;
use App\BanNama;
use App\BanUkuran;
use App\CatDetail;
use App\CatNama;
use App\CatType;
use App\DetailBan;
use App\LoanProses;
use App\Pinjaman;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoanProsesController extends Controller
{

    public function addData($id)
    {
        $ukuran = CatDetail::find($id);

        return response()->json($ukuran);
    }

    public function store(Request $request)
    {
        $detail = CatDetail::find($request->idDetail);
        $stock = $detail->stock;
        // return response()->json($stock);

        if ($request->jumlah > $stock) {
            $nilai = [
                'success' => false,
                'stock' => $stock,
              ] ;
            return response()->json($nilai,422);

        }else{

            DB::transaction(function () use ($request, $detail) {

                if ($loan = LoanProses::where('detail_id',$request->idDetail)->first()) {
                    // $jumlah = $loan->jumlah;

                    // $jumlah_loan = $jumlah + $request->jumlah;
                    // $stock_detail = $detail->stock - $request->jumlah;

                    $loan->jumlah = $loan->jumlah + $request->jumlah;
                    $loan->save();
                    // DB::table('loan')->where('id_detail', $request->idDetail)->update(['jumlah'=> $jumlah_loan ]);

                    $detail->stock = $detail->stock - $request->jumlah;
                    $detail->save();
                    // DB::table('detail_ban')->where('id', $request->idDetail)->update(['stock'=> $stock_detail ]);
                    // $detail->stock = $detail->stock - $request->jumlah;


                }else{

                    $kendaraan = $detail->kendaraan_id;
                    $type = $detail->type_id;
                    $nama = $detail->nama_id;


                LoanProses::create([
                    'kendaraan_id'=>$kendaraan,
                    'type_id'=>$type,
                    'nama_id'=>$nama,
                    'detail_id'=>$request->idDetail,
                    'jumlah'=>$request->jumlah,
                ]);

                $detail->stock = $detail->stock - $request->jumlah;
                $detail->save();

                }

            });

            $nilai = [
                'stock' => $stock,
                'message'=> 'success'
              ] ;

        }

        return response()->json(['success'=>'Successfuly Add Data'],200);


    }

    public function destroy($id)
    {
        $restore = LoanProses::where('detail_id',$id)->first();

        $detail = CatDetail::where('id',$id)->first();

        DB::transaction(function () use ($id, $detail, $restore) {

            // foreach($restore as $jlm){
            //     $old_jumlah = $jlm->jumlah;
            // }

            // foreach($detail as $stc){
            //     $old_stock = $stc->stock;
            // }

            // $new_stock = $old_stock + $old_jumlah;

            //update stock ban_detail
            $detail->stock = $detail->stock + $restore->jumlah;
            $detail->save();
            // DB::table('detail_ban')->update(['stock'=> $new_stock]);

            //delete tablle loan berdasarkan id
            $restore->delete();
            // Loan::where('id_detail',$id)->delete();

            // DB::table('loan')->where('id_detail', $id)->delete();
        });

        // $newStock = $oldStock + $oldJumlah;

        // DB::table('detail_ban')->where('id', $id)->update(['stock'=> $newStock]);

        // Loan::where('id_detail',$id)->delete();
        return response()->json(['success'=>'Item deleted successfully.']);
    }

    public function selectType($id)
    {
        $type = CatType::where('kendaraan_id', $id)->pluck('type_nama','id');
        return json_encode($type);
    }

    public function selectNama($id)
    {
        $nama = CatNama::where('type_id', $id)->pluck('ban_nama','id');
        return json_encode($nama);
    }

    public function detailBan(Request $request, $id)
    {

        if ($request->ajax()) {
            $output = '';

            if ($id != '') {
                $data = CatDetail::where('nama_id', $id)->get();
            }else {
                $data = CatDetail::all();
            }
            $no=1;
        foreach($data as $row)
        {
            if (!$row->rim) {
                $rim = '<i>Null</i>';
            }else{
                $rim = $row->rim;
            }
            if (!$row->pelek) {
                $pelek = '<i>Null</i>';
            }else{
                $pelek = $row->pelek;
            }
            if (!$row->tipe) {
                $tipe = '<i>Null</i>';
            }else{
                $tipe = $row->tipe;
            }
            if (!$row->ply) {
                $ply = '<i>Null</i>';
            }else{
                $ply = $row->ply;
            }

            $output .= '
            <tr>
            <td width="10">'.$no++.'</td>
            <td>'.$row->ukuran_ban.'</td>
            <td>'.$rim.'</td>
            <td>'.$pelek.'</td>
            <td>'.$tipe.'</td>
            <td>'.$ply.'</td>
            <td>'.$row->stock.'</td>
            <td>'.$row->created_at->format('D, d M y').'</td>
            <td width="10"><button type="button" id="addData" data-id="'.$row->id.'" class="add btn btn-info btn-sm"><i class="fa fa-plus"></i></button></td>
            </tr>
            ';
        }
        $data = array(
            'table_data'  => $output,
           );
        }

        return json_encode($data);
    }



    public function dataTableLoan(Request $request)
    {
        if ($request->ajax()) {
            $data = LoanProses::all();
            return Datatables::of($data)
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
                    ->editColumn('detail', function($data){
                        $nama = $data->detail->ukuran_ban;
                        return $nama;
                    })

                    ->addColumn('action', function($data){
                         $action = '<button type="button" id="deleteDetail" data-id="'.$data->detail_id.'" class="delete btn btn-danger btn-xs"><i class="fa fa-eraser"></i></button>';
                         return $action;
                         })
                    ->rawColumns(['action','kendaraan','type','nama','detail'])
                    ->make(true);
        return json_encode($data);

        }

    }


}
