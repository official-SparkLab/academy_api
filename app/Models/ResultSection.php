<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultSection extends Model
{
    protected $table="resultsection";
    protected $primarykey="id";
    protected $fillable = ['section', 'result_year', 'added_by', 'reg_id'];
}
