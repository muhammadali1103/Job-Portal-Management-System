<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = ['country', 'city'];

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }
}
