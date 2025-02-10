<?php

namespace App\Services;

use App\Exceptions\OrderNotFoundException;
use App\Repositories\OrderRepository;

class OrderService
{
    private $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function index(array $data)
    {
        $idClient = $data['id_client'] ?? null;
        $orders = $this->orderRepository->index($idClient);

        if ($orders->isEmpty()) {
            throw new OrderNotFoundException('Não há pedidos para os critérios informados.', 404);
        }

        return $orders;
    }
}
