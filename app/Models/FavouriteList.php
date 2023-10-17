<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FavouriteList extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function favourite(): HasMany
    {
        return $this->hasMany(favourite::class);
    }
}
