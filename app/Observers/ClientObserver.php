<?php

namespace App\Observers;

use App\Models\Client;
use App\Repositories\OrderRepository;

class ClientObserver
{
    public function deleting(Client $client)
    {
        app(OrderRepository::class)->customDelete('id_client', $client->id);
    }
}
