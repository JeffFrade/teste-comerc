<?php

namespace App\Observers;

use App\Models\Order;
use App\Repositories\OrderItemRepository;

class OrderObserver
{
    public function deleting(Order $order)
    {
        app(OrderItemRepository::class)->customDelete('id_order', $order->id);
    }
}
