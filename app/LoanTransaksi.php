<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanTransaksi extends Model
{
    protected $table = 'loan_transaksi';

    // protected $fillable = ['id_staf','no_issue','faktu'];
    protected $guarded =[];


    public function loanProses()
    {
        return $this->hasMany(LoanProses::class,'id_loan','id');
    }
    public function staf()
    {
        return $this->hasOne(Staf::class,'id','staf_id');
    }

    public function transaksi()
    {
        return $this->hasOne(Loan::class,'id','loan_id');
    }

    public function nama()
    {
        return $this->hasOne(CatNama::class,'id','nama_id');
    }
    public function type()
    {
        return $this->hasOne(CatType::class,'id','type_id');
    }
    public function kendaraan()
    {
        return $this->hasOne(CatKendaraan::class,'id','kendaraan_id');
    }
    public function detail()
    {
        return $this->hasOne(CatDetail::class,'id','detail_id');
    }

}
