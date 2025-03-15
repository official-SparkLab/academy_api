<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table="Course";
    protected $primarykey="id";

    protected $fillable=[
        'course',
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
        'sub_section',
        'added_by',
        'reg_id'
    ];
}
