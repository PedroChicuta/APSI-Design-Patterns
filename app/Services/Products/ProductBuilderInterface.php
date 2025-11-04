<?php 

namespace App\Services\Products;

interface ProductBuilderInterface{
    public function getProduct();
    public function save();
    public function setBasicInfo(array $data);
    public function setAttributes(array $attributes);
    
}