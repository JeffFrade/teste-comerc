<?php

namespace App\Services;

use App\Exceptions\ProductNotFoundException;
use App\Repositories\ProductRespository;

class ProductService
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRespository();
    }

    public function index(array $data)
    {
        $search = $data['search'] ?? '';

        $products = $this->productRepository->index($search);

        if ($products->isEmpty()) {
            throw new ProductNotFoundException('Não há produtos para os critérios informados.');
        }

        return $products;
    }
}
