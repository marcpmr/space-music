<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favourite extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function FavouriteList(): BelongsTo
    {
        return $this->belongsTo(FavouriteList::class, 'favouritelist_id');
    }

}
