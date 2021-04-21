<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockDetail extends Model
{
    protected $table = 'stock_detail';

    // public $timestamps = false;
    protected $fillable = [ 'user_id',
                            'detail_id',
                            'staf_id',
                            'stock_input',
                            'stock_output',
                            'stock_update',
                            'status'
                            ];

    // protected $guarded =[];

    // public function transaksi()
    // {
    //  return $this->belongsTo(Transaksi::class,'id','id_staf');
    // }
}
