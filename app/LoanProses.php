<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanProses extends Model
{
    protected $table = 'loan_proses';

    protected $fillable = ['kendaraan_id','type_id','nama_id','detail_id','jumlah'];

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
