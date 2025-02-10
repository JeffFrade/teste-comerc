<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Models\OrderItem;

class OrderItemRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new OrderItem();
    }
}
