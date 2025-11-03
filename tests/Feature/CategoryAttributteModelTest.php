<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\CategoryAttribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryAttributteModelTest extends TestCase
{
    use RefreshDatabase;
    public function test_the_application_creates_a_categorty_attribute(): void
    {
        $category = Category::create([
            'name' => 'Comida',
            'description' => 'Categoria de comidas'
        ]);

        $categoryAttribute = CategoryAttribute::create([
            'category_id' => $category->id,
            'name'  => 'Peso',
            'type' => 'text',
            'unit' =>  'gramas'
        ]);

        $this->assertDatabaseHas('category_attributes', [
            'category_id' => $category->id,
            'name' => 'Peso',
            'type' => 'text',
            'unit' =>  'gramas'
        ]);
    }
}
