<?php

namespace App\Services\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Services\Products\ProductBuilderInterface;

class ProductClothingBuilder implements ProductBuilderInterface
{
    private Product $product;
    protected Category $category;  
    protected array $attributes = []; 

    public function __construct()
    {
        $this->product = new Product();
    }

    public function setBasicInfo(array $data): self
    {
        $this->category = Category::where('name', $data['category'])->firstOrFail();

        $this->product->name = $data['name'];
        $this->product->price = $data['price'];
        $this->product->description = $data['description'] ?? null;
        $this->product->category_id = $this->category->id;

        return $this;
    }

    public function setAttributes(array $attributes): self
    {
        if (isset($attributes['Tamanho']) && !in_array($attributes['Tamanho'], ['P', 'M', 'G', 'GG'])) {
            throw new \Exception("Tamanho inválido para roupas.");
        }
        
        $this->attributes = $attributes;

        return $this;
    }

    public function save(): Product
    {
        $this->product->save();

        foreach ($this->attributes as $name => $value) {
            $attr = $this->category->attributes()->where('name', $name)->first();

            if (!$attr) {
                throw new \Exception("Atributo '$name' não existe para a categoria '{$this->category->name}'");
            }

            $attrValue = new ProductAttributeValue([
                'product_id' => $this->product->id,
                'category_attribute_id' => $attr->id,
            ]);

            switch ($attr->type) {
                case 'number':
                    $attrValue->value_number = $value;
                    break;
                case 'decimal':
                    $attrValue->value_decimal = $value;
                    break;
                case 'date':
                    $attrValue->value_date = $value;
                    break;
                case 'boolean':
                    $attrValue->value_boolean = $value;
                    break;
                default:
                    $attrValue->value_text = $value;
            }

            $attrValue->save();
        }

        return $this->product;
    }

    public function getProduct()
    {
        return $this->product;
    }
}