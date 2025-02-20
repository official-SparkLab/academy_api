<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table="About";
    protected $primarykey="id";

    protected $fillable=[
        'image_url',
        'heading_small',
        'heading_medium',
        'heading_large',
        'button_label',
        'destination_url',
        'description',
        'icon',
        'photo',
        'section',
        'added_by',
        'reg_id'
    ];
}
