<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\OrderItemService;

class OrderItemController extends Controller
{
    private $orderItemService;

    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
    }
}
