<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    protected $fillable = ['product_id', 'quantity', 'unit_cost', 'total_cost', 'purchase_date'];
    // A purchase belongs to a product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}