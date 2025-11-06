<?php

namespace App\Services\Products;

use App\Models\Product;
use App\Services\Products\ProductBuilderInterface;
use App\Services\Products\ProductClothingBuilder;
use Exception;
use Illuminate\Http\Request;

class ProductFactory
{
    public static function create(array $data): ProductBuilderInterface
    {
        $productCategory = $data['category'];
        return match (strtolower($productCategory)) {
            'roupas' => new ProductClothingBuilder(),
            'eletrônicos' => new ProductEletronicBuilder(),
            default => throw new Exception("Nenhum builder definido para a categoria '$productCategory'")
        };
    }
}