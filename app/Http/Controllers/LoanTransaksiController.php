<?php

namespace App\Http\Controllers;

use App\Loan;
use App\LoanProses;
use App\LoanTransaksi;
use App\Staf;
use App\TransaksiLoan;
use App\Transaksi;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanTransaksiController extends Controller
{
    public function store(Request $request)
    {
        // return response()->json($request);

        $tran = Loan::count();

        DB::transaction(function () use ($request,$tran){

        $date = Carbon::now()->format('Ym');
        $no  = 1 + $tran;
        $no_issue = $date.$no;
        $id_user = Auth::user()->id;

        $transaksi = $request->validate([
            'id_staf' => 'required',
            'faktur' => 'required',
              ]);

        $transaksi['users_id'] = $id_user;
        $transaksi['staf_id'] = request('id_staf');
        $transaksi['no_issue'] = $no_issue;
        $transaksi['faktur'] = request('faktur');
        //simpan data transaksi
        $trans = Loan::create($transaksi);
        //get last id transaksi
        $id_transaksi = $trans->id;
        //panggil semua data loan
        $loan = LoanProses::get();
        //perulangan get semua data Loan tranfert to TransaksiLoan
        foreach ($loan as $key => $value) {

            $loanTransaksi[$key] = new LoanTransaksi();
            $loanTransaksi[$key]->loan_id = $id_transaksi;
            $loanTransaksi[$key]->kendaraan_id = $value->kendaraan_id;
            $loanTransaksi[$key]->type_id = $value->type_id;
            $loanTransaksi[$key]->nama_id = $value->nama_id;
            $loanTransaksi[$key]->detail_id = $value->detail_id;
            $loanTransaksi[$key]->jumlah = $value->jumlah;
            $loanTransaksi[$key]->save();

        }
        //delete table loan
        DB::table('loan_proses')->delete();

        });

        $staf = Staf::all()->pluck('nama','id');
        // session()->forget(['staf','faktur']);

        session()->forget(['staf','faktur']);
        // return view('loan.index', compact('staf'));
        return response()->json(['success'=>'Pinjaman Successfuly'],200);
    }
}
