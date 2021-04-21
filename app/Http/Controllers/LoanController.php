<?php

namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Staf;

use App\BanKendaraan;
use App\CatDetail;
use App\CatKendaraan;
use App\Loan;
use App\DetailBan;
use App\LoanProses;
use App\LoanTransaksi;
use App\Transaksi;
use App\TransaksiLoan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{

    public function index(Request $request){

        $kendaraan = CatKendaraan::all()->pluck('kendaraan_nama','id');
        $faktur = $request->session('faktur');
        $staf = Staf::all()->pluck('nama','id');


        if ($request->session()->has(['staf','faktur'])) {
            $staf = Staf::findOrFail($request->session()->get('staf'));
            // return redirect()->route('loan.data', compact('kendaraan','staf'));
        return view('loan.data', compact('kendaraan','staf'));


        }else{

            return view('loan.index', compact('staf'));
        }

    }

    public function data(Request $request)
    {

        // dd($request);

        $faktur = $request->faktur;
        $staf = staf::findOrFail($request->id_staf);

        $request->session()->put('faktur',$request->faktur);
        $request->session()->put('staf',$request->id_staf);
        $staf = staf::findOrFail($request->session()->get('staf'));
        $kendaraan = CatKendaraan::all()->pluck('kendaraan_nama','id');

        return view('loan.data', compact('kendaraan','staf','faktur'));
    }



    public function sessionFlush(Request $request)
    {
        $staf = Staf::all()->pluck('nama','id');

        $data = LoanProses::all();

        foreach ($data as $key => $value) {
            $nilai = [
                $id = $value->detail_id,
                $jumlah =  $value->jumlah,
            ];

        $detail = CatDetail::findOrFail($id);

        $new_stock = $detail->stock + $jumlah;

        CatDetail::where('id', $id)->update(['stock'=> $new_stock ]);
        // DB::table('detail_ban')->where('id', $id)->update(['stock'=> $new_stock ]);

        }

        // $request->session()->flush();
        session()->forget(['staf','faktur']);
        // LoanProses::delete();
        DB::table('loan_proses')->delete();

        return view('loan.index', compact('staf'));

    }

    public function dataTableLoanTransaksi(Request $request)
    {
        if ($request->ajax()) {
            $data = Loan::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('staf', function($data){
                        $staf = $data->staf->nama;
                        return $staf;
                    })
                    ->editColumn('waktu', function($data){
                        $waktu = $data->created_at->format('D, d M y');
                        return $waktu;
                    })
                    ->addColumn('action', function($data){
                         $action = '<a href="javascript:void(0)" id="detailPinjaman" class="btn btn-success btn-xs detailPinjaman" data-id='.$data->id.'><i class="fa fa-eye"></i></a>
                                    <button type="button" id="deleteDetail" data-id="'.$data->id.'" class="delete btn btn-danger btn-xs"><i class="fa fa-eraser"></i></button>';
                         return $action;
                         })
                    ->rawColumns(['action','staf','waktu'])
                    ->make(true);
        return json_encode($data);

        }
    }

    public function getIdPinjaman(Request $request,$id)
    {


            $data = staf::with('transaksi.loanTransaksi.kendaraan','transaksi.loanTransaksi.type','transaksi.loanTransaksi.type','transaksi.loanTransaksi.detail')->where('id',$id)->get();
        return response()->json($data);


    }

    public function showDataLoan(Request $request,$id)
    {
        if ($request->ajax()) {
            $output = '';

            if ($id != '') {
                $data = LoanTransaksi::where('loan_id', $id)->get();
            }else {
                $data = LoanTransaksi::all();
            }
            $no=1;
        foreach($data as $row)
        {
            $total = $data->sum('jumlah');
            $output .= '
            <tr>
            <td width="10">'.$no++.'</td>
            <td>'.$row->detail->ukuran_ban.'</td>
            <td>'.$row->jumlah.'</td>
            <td>'.$row->nama->ban_nama.'</td>
            <td>'.$row->type->type_nama.'</td>
            <td>'.$row->kendaraan->kendaraan_nama.'</td>
            </tr>
            ';
        }
        $data = array(
            'table_data'  => $output,
            'faktur'  => $row->transaksi->faktur,
            'nama' => $row->transaksi->staf->nama,
            'waktu' => $row->transaksi->created_at->format('d-m-Y'),
            'issue' => $row->transaksi->no_issue,
            'jabatan' => $row->transaksi->staf->jabatan,
            'harga' => 'Rp '.number_format($row->detail->harga,2),
           );
        }
        return json_encode($data);
    }



}
