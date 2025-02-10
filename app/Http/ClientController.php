<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\ClientService;

class ClientController extends Controller
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }
}
