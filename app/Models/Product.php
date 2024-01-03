<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'quantity'
    ];

    /**
     * Get the category that owns the product.
     * 
     * @return BelongsTo belongsTo relationship  with Category model
     */
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
