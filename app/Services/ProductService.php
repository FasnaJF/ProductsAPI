<?php

namespace App\Services;

use App\Repositories\ProductRepository\ProductRepositoryInterface;

class ProductService
{
    private ProductRepositoryInterface $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function getAllProducts($request)
    {
        return $this->productRepo->getAllWithQueryParams($request);
    }

    public function getProductById($id)
    {
        return $this->productRepo->getById($id);
    }
}
