<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAttributeValue extends Model
{
    protected $table = 'product_attribute_values';

    protected $fillable = [
        'product_id',
        'category_attribute_id',
        'value_text',
        'value_number',
        'value_decimal',
        'value_date',
        'value_boolean',
    ];

 
    protected $casts = [
        'value_text' => 'string',
        'value_number' => 'integer',
        'value_decimal' => 'decimal:2',
        'value_date' => 'date',
        'value_boolean' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function categoryAttribute(): BelongsTo
    {
        return $this->belongsTo(CategoryAttribute::class);
    }
}
