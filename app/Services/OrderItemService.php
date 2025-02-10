<?php

namespace App\Services;

use App\Repositories\OrderItemRepository;

class OrderItemService
{
    private $orderItemRepository;

    public function __construct()
    {
        $this->orderItemRepository = new OrderItemRepository();
    }
}
