<?php

namespace Tests\Unit\Services;

use App\Exceptions\OrderNotFoundException;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $orderService;

    public function setUp(): void
    {
        parent::setUp();
        $this->orderService = new OrderService();
    }

    public function testIndexOrder(): void
    {
        $orders = $this->orderService->index([
            'id_client' => 1
        ]);

        $this->assertNotEmpty($orders);
        $this->assertGreaterThanOrEqual(1, $orders->count());
    }

    public function testWrongIndexOrder(): void
    {
        $this->expectException(OrderNotFoundException::class);

        $this->orderService->index([
            'id_client' => 100000000000000000
        ]);
    }

    public function testStoreOrder(): void
    {
        $order = $this->storeOrder();

        $this->assertInstanceOf(Order::class, $order);
        $this->assertNotEmpty($order);
        $this->assertEquals(1, $order->id_client);
    }

    public function testEditOrder(): void
    {
        $order = $this->storeOrder();
        $order = $this->orderService->edit($order->id);

        $this->assertInstanceOf(Order::class, $order);
        $this->assertNotEmpty($order);
        $this->assertEquals(1, $order->id_client);
    }

    public function testWrongEditOrder(): void
    {
        $this->expectException(OrderNotFoundException::class);

        $id = 0;
        $this->orderService->edit($id);
    }

    public function testUpdateOrder(): void
    {
        $order = $this->storeOrder();

        $this->orderService->update([
            'id_client' => 12
        ], $order->id);

        $order = $this->orderService->edit($order->id);

        $this->assertInstanceOf(Order::class, $order);
        $this->assertNotEmpty($order);
        $this->assertEquals(12, $order->id_client);
    }

    public function testDeleteOrder(): void
    {
        $this->expectException(OrderNotFoundException::class);

        $order = $this->storeOrder();
        $this->orderService->delete($order->id);
        $this->orderService->edit($order->id);
    }

    private function storeOrder(): Order
    {
        return $this->orderService->store([
            'id_client' => 1,
            'items' => [
                [
                    'id_product' => 10,
                    'amount' => 3
                ],
                [
                    'id_product' => 8,
                    'amount' => 7
                ]
            ]
        ]);
    }
}