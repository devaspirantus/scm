<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Student;
class Entrolment extends Model
{
    protected $table = 'enrolements';

    protected $fillable = [
        'studentID',
        'courseID',
        'enrolements_date',
    ];

    public function student():BelongsTo
    {
        return $this->belongsTo(Student::class, 'studentID');
    }
}
