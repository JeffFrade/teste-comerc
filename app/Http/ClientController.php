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

    public function store(Request $request)
    {
        $params = $this->toValidate($request);
        $client = $this->clientService->store($params);

        return $this->sendJsonSuccessResponse('Cliente cadastrado com sucesso!', $client);
    }

    public function edit(int $id)
    {
        try {
            $client = $this->clientService->edit($id);

            return $this->sendJsonSuccessResponse('Dados do cliente encontrados!', $client);
        } catch (ClientNotFoundException $e) {
            return $this->sendJsonErrorResponse($e);
        }
    }

    protected function toValidate(Request $request, ?int $id = null)
    {
        return $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|max:175|unique:clients,email,' . $id,
            'phone' => 'required|min:10|max:15',
            'birth_date' => 'required|date',
            'cep' => 'required|min:8|max:9',
            'address' => 'required|max:150',
            'number' => 'required|max:15',
            'complement' => 'nullable|max:20',
            'neighborhood' => 'required|max:50'
        ]);
    }
}
