<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrolment extends Model
{
    protected $table = 'enrolements';

    protected $fillable = [
        'studentID',
        'courseID',
        'enrolements_date',
    ];
}
