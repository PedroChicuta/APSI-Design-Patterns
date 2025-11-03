<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductAttributeValueTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_creates_a_category_attribute_value(): void
    {
        $category = Category::create([
            'name' => 'Comida',
            'description' => 'Categoria de comidas'
        ]);

        $categoryAttribute = CategoryAttribute::create([
            'category_id' => $category->id,
            'name'  => 'Peso',
            'type' => 'number',
            'unit' =>  'gramas'
        ]);

        $product = Product::create([
            'name' => 'Cuscuz Coringa',
            'price' => 59.90,
            'category_id' => $category->id
        ]);
        
        $productAttributeValue = ProductAttributeValue::create([
            'category_attribute_id' => $categoryAttribute->id,
            'product_id' => $product->id,
            'value_number' => 500
        ]);

        $this->assertDatabaseHas('product_attribute_values', [
            'category_attribute_id' => $categoryAttribute->id,
            'product_id' => $product->id,
            'value_number' => 500
        ]);

    }
}
