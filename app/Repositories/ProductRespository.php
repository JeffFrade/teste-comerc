<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Models\Product;

class ProductRespository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Product();
    }

    public function index(string $search = '')
    {
        return $this->model->where('name', 'LIKE', '%' . $search . '%')
            ->paginate();
    }
}
