<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatNama extends Model
{
    protected $table = 'cat_nama_ban';

    protected $fillable = ['kendaraan_id','type_id','ban_nama'];

    public function ukuran()
    {
        return $this->hasMany(DetailBan::class);
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
