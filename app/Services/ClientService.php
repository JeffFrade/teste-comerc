<?php

namespace App\Services;

use App\Repositories\ClientRepository;

class ClientService
{
    private $clientRepository;

    public function __construct()
    {
        $this->clientRepository = new ClientRepository();
    }
}
