<?php

namespace App\Observers;

use App\Models\Product;
use App\Repositories\OrderItemRepository;

class ProductObserver
{
    public function deleting(Product $product)
    {
        app(OrderItemRepository::class)->customDelete('id_product', $product->id);
    }
}
