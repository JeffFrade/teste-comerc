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

    public function deleteByIdOrder(int $idOrder)
    {
        $this->orderItemRepository->customDelete('id_order', $idOrder);
    }

    public function store(array $data)
    {
        return $this->orderItemRepository->create($data);
    }
}
