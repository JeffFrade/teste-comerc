<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Models\Client;

class ClientRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Client();
    }

    public function index(string $search = '')
    {
        return $this->model->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->paginate();
    }
}
