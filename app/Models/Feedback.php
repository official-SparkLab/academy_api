<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'Feedback';
    protected $primaryKey = 'id';
   

    protected $fillable = [
        'question',
        'answer',
        'feedback',
        'reason',
    ];
}
