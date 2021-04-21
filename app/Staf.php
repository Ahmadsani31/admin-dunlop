<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staf extends Model
{
    protected $table = 'staf';

    // public $timestamps = false;
    protected $fillable = [ 'user_id',
                            'id_staf',
                            'nama',
                            'jabatan',
                            'email',
                            'phone',
                            'alamat',
                            'image'
                            ];

    // protected $guarded =[];

    public function transaksi()
    {
     return $this->belongsTo(Loan::class,'id','staf_id');
    }
}
