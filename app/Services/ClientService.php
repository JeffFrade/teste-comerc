<?php

namespace App\Services;

use App\Exceptions\ClientNotFoundException;
use App\Helpers\StringHelper;
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

    public function store(array $data)
    {
        $data = $this->formatData($data);

        return $this->clientRepository->create($data);
    }

    public function edit(int $id)
    {
        $client = $this->clientRepository->findFirst('id', $id);

        if (empty($client)) {
            throw new ClientNotFoundException('Cliente inexistente.', 404);
        }

        return $client;
    }

    public function update($data, $id)
    {
        $this->edit($id);
        $data = $this->formatData($data);

        $this->clientRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        $this->edit($id);
        $this->clientRepository->delete($id);
    }

    private function formatData(array $data)
    {
        if (!empty($data['cep'] ?? '')) {
            $data['cep'] = StringHelper::replaceRegex($data['cep'], '/[\D]/i', '');
        }

        if (!empty($data['phone'] ?? '')) {
            $data['phone'] = StringHelper::replaceRegex($data['phone'], '/[\D]/i', '');
        }

        return $data;
    }
}
