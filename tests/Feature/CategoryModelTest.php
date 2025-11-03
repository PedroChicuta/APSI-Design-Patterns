<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_creates_a_category(): void
    {
        $category = Category::create([
            'name' => 'Roupas',
            'description' => 'Categoria de roupas e acessórios'
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Roupas',
            'description' => 'Categoria de roupas e acessórios',
        ]);
    }
}
