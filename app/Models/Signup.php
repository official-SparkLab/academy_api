<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{
    protected $table="Signup";
    protected $primarykey="id";

    protected $fillable=[
        'full_name',
        'department',
        'designation',
        'contact',
        'email',
        'username',
        'password'
    ];
}
