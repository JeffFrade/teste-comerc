<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Exceptions\ClientNotFoundException;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index(Request $request)
    {
        try {
            $params = $request->all();

            $clients = $this->clientService->index($params);

            return $this->sendJsonSuccessResponse('Dados encontrados!', $clients);
        } catch (ClientNotFoundException $e) {
            return $this->sendJsonErrorResponse($e);
        }
    }
}
