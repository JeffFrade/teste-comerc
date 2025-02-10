<?php

namespace App\Events;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $order;
    private $client;

    /**
     * Create a new event instance.
     */
    public function __construct(Order $order, Client $client)
    {
        $this->order = $order;
        $this->client = $client;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function getClient()
    {
        return $this->client;
    }
}
