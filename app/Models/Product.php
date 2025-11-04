<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'description',
        'category_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'name' => 'string',
        'description' => 'string',
        'category_id' => 'integer'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function attributesValues(): HasMany
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
}
