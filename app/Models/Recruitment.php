<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    protected $table = "Recruitment";
    protected $primaryKey = "id";
    public $timestamps = true;

    protected $fillable = [
        'job_title',
        'about_job',
        'qualification',
        'total_vacancies',
        'total_experience',
        'department',
        'age_limit',
        'work_place',
        'apply_start_date',
        'apply_last_date',
        'mobile_no',
        'apply_link',
        'added_by',
        'reg_id'
    ];
}
