<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactEnquiry extends Model
{
    protected $table="ContactEnquiry";
    protected $primarykey="id";

    protected $fillable=[
        'full_name',
        'phone',
        'email',
        'city',
        'state',
        'class',
        'stream',
        'comments'
      
    ];
}
