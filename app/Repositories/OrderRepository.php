<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Models\Order;

class OrderRepository extends AbstractRepository
{
    public function __construct(Order $order)
    {
        $this->model = $order;
    }
}
