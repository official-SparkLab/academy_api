<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table="Gallery";
    protected $primarykey="id";

    protected $fillable=[
        'section',
        'sub_section',
        'title',
        'heading',
        'image',
        'video_link',
        'added_by',
        'reg_id'
      
    ];
}
