<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['name', 'category', 'price', 'stock'];
    // A product can belong to many orders (via pivot table)
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity', 'unit_price', 'total_price')
            ->withTimestamps();
    }

    // A product can have many purchases (stock replenishments)
    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }
}