<?php

namespace App\Services;

use App\Exceptions\OrderNotFoundException;
use App\Repositories\OrderRepository;

class OrderService
{
    private $orderRepository;
    private $clientService;
    private $productService;
    private $orderItemService;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->clientService = new ClientService();
        $this->productService = new ProductService();
        $this->orderItemService = new OrderItemService();
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

    public function store(array $data)
    {
        $client = $this->clientService->edit($data['id_client']);

        $order = $this->orderRepository->create($data);

        $this->storeItems($data['items'], $order->id);

        // TODO: Dispatch e-mail.

        return $order;
    }

    public function edit(int $id)
    {
        $order = $this->orderRepository->edit($id);

        if (empty($order)) {
            throw new OrderNotFoundException('Pedido inexistente.');
        }

        return $order;
    }

    public function update(array $data, int $id)
    {
        $this->edit($id);

        $this->orderRepository->update($data, $id);

        $this->storeItems($data['items'] ?? [], $id);
    }

    public function delete(int $id)
    {
        $this->edit($id);
        $this->orderRepository->delete($id);
    }

    private function storeItems(array $items, int $idOrder)
    {
        if (count($items) > 0) {
            $this->orderItemService->deleteByIdOrder($idOrder);

            foreach ($items as $value) {
                $this->productService->edit($value['id_product'] ?? 0);

                $data = [
                    'id_order' => $idOrder,
                    'id_product' => $value['id_product'],
                    'amount' => $value['amount'] ?? 1
                ];

                $this->orderItemService->store($data);
            }
        }
    }
}
