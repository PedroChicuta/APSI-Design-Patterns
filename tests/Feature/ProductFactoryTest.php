<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Services\Products\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductFactoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $category = Category::create([
            'name' => 'roupas',
            'description' => 'Produtos de moda'
        ]);
        
        CategoryAttribute::create([
            'category_id' => $category->id,
            'name' => 'Cor',
            'type' => 'text'
        ]);

        CategoryAttribute::create([
            'category_id' => $category->id,
            'name' => 'Tamanho',
            'type' => 'text'
        ]);

        $productInfo = [
            'name' => 'Camisa',
            'price' => '25',
            'description' => 'Camiseta com manga',
            'category' => 'roupas'
        ];

        $productBuilder = ProductFactory::create($productInfo);

        $productBuilder->setBasicInfo($productInfo);

        $data = [
            'Cor' => 'Vermelho',
            'Tamanho' => 'G'
        ];

        $productBuilder->setAttributes($data);

        $productBuilder->save();

        $product = $productBuilder->getProduct();
        
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'category_id' => $category->id,
            'price' => '25',
            'description' => 'Camiseta com manga',
        ]);
    }
}
