<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatKendaraan extends Model
{
    protected $table = 'cat_kendaraan';

    protected $fillable = ['kendaraan_nama'];

    public function type()
    {
        return $this->hasMany(BanType::class);
    }
}
