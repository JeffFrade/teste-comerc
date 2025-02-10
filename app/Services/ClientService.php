<?php

namespace App\Services;

use App\Exceptions\ClientNotFoundException;
use App\Repositories\ClientRepository;

class ClientService
{
    private $clientRepository;

    public function __construct()
    {
        $this->clientRepository = new ClientRepository();
    }

    public function index(array $data)
    {
        $search = $data['search'] ?? '';

        $clients = $this->clientRepository->index($search);

        if ($clients->isEmpty()) {
            throw new ClientNotFoundException('Não há clientes para os critérios informados', 404);
        }

        return $clients;
    }
}
