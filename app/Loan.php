<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loan';

    protected $fillable = ['users_id','staf_id','no_issue','faktur'];

    public function loanTransaksi()
    {
        return $this->hasMany(TransaksiLoan::class,'id_loan','id');
    }
    public function staf()
    {
        return $this->hasOne(Staf::class,'id','staf_id');
    }
    // public function nama()
    // {
    //     return $this->hasOne(CatNama::class,'id','id_nama');
    // }
    // public function type()
    // {
    //     return $this->hasOne(CatType::class,'id','id_type');
    // }
    // public function kendaraan()
    // {
    //     return $this->hasOne(CatKendaraan::class,'id','id_kendaraan');
    // }
    // public function detail()
    // {
    //     return $this->hasOne(CatDetail::class,'id','id_detail');
    // }
}
