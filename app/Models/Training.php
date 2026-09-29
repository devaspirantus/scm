<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = 'trainings';
    protected $fillable = [
        'courseID',
        'price',
        'start_date',
        'end_date',
        'notes'
    ];
    public function course()
    {
        return $this->belongsTo(Course::class,'courseID');
    }
}
