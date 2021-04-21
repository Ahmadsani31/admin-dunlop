<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatType extends Model
{
    protected $table = 'cat_type_ban';

    protected $fillable = ['kendaraan_id','type_nama'];

    // protected $guarded =[];
    // public $timestamps = false;

    public function nama()
    {
        return $this->hasMany(BanNama::class);
    }
    public function kendaraan()
    {
        return $this->hasOne(CatKendaraan::class,'id','kendaraan_id');
    }
}
