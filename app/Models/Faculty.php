<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table="Faculty";
    protected $primarykey="id";

    protected $fillable=[
        'department',
        'photo',
        'title',
        'name',
        'designation',
        'experience',
        'added_by',
        'reg_id'
      
    ];
}
