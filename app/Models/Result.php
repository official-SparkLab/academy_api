<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table="result";
    protected $primarykey="id";
    protected $fillable = ['section', 'sub_section','image','name','description', 'added_by', 'reg_id'];
}
