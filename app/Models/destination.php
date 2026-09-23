<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\Country;

class destination extends Model
{

protected $table = 'destinations';

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'country_id',
    ];
 
   public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    } 

}
