<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = ['name', 'phone'];
    // A client can have many orders
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}