<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    protected $table="chatbot";
    protected $primarykey="id";

    protected $fillable=[
        'question',
        'answer',
        'designation',
        'question_type',
        
      
    ];
}
