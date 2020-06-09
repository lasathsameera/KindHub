<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $fillable = [
        'class_room', 'teachers_name', 'student_firstname','student_lastname','gender','status','joined_year'
    ];
}
