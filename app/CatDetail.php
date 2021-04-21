<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatDetail extends Model
{
    protected $table = 'cat_detail_ban';

    protected $fillable = ['user_id',
                            'kendaraan_id',
                            'type_id',
                            'nama_id',
                            'ukuran_ban',
                            'stock',
                            'harga',
                            'rim',
                            'pelek',
                            'tipe',
                            'ply'
                        ];
    // protected $guarded =[];
    // public $timestamps = false;


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
}
