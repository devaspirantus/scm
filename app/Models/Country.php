<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\destination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = [
        'name',
        'active',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function destination()
    {
        return $this->hasOne(destination::class,'country_id');
    }
}
