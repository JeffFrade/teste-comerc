<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Models\Order;

class OrderRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Order();
    }

    public function index(?int $idClient = null)
    {
        $model = $this->model->with('items');

        if (!is_null($idClient)) {
            $model = $model->where('id_client', $idClient);
        }

        return $model->paginate();
    }

    public function edit(int $id)
    {
        return $this->model->with('items')
            ->where('id', $id)
            ->first();
    }
}
