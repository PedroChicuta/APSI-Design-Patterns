<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryAttribute extends Model
{
    protected $table = 'category_attributes';

    protected $fillable = [
        'category_id',
        'name',
        'type',
        'unit'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function values(): HasMany
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
}
