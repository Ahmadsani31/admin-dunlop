<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadImage extends Model
{
    protected $table = 'upload_images';

    public $timestamps = false;

    protected $fillable = ['id_card','nama','description','image'];

}
