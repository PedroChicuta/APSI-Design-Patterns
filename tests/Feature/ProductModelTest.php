<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_creates_a_product()
    {
        $category = Category::create([
            'name' => 'Roupas',
            'description' => 'Categoria de roupas e acessórios'
        ]);


        $product = Product::create([
            'name' => 'Camiseta Azul',
            'price' => 59.90,
            'category_id' => $category->id
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Camiseta Azul',
            'price' => 59.90,
        ]);
    }

    public function test_the_product_belongs_to_a_category()
    {
        $category = Category::create([
            'name' => 'Calçados',
            'description' => 'Tênis, botas e sapatos'
        ]);

        $product = Product::create([
            'name' => 'Tênis Branco',
            'price' => 199.99,
            'category_id' => $category->id
        ]);

        $this->assertEquals('Calçados', $product->category->name);
    }
}
