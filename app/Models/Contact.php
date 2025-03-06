<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table="contact";
    protected $primarykey="id";

    protected $fillable=[
        'email',
        'address',
        'contact'
    ];
}
