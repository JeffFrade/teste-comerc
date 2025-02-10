<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Exceptions\ClientNotFoundException;
use App\Exceptions\OrderNotFoundException;
use App\Exceptions\ProductNotFoundException;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        try {
            $params = $request->all();

            $orders = $this->orderService->index($params);

            return $this->sendJsonSuccessResponse('Dados encontrados!', $orders);
        } catch (OrderNotFoundException $e) {
            return $this->sendJsonErrorResponse($e);
        }
    }

    public function store(Request $request)
    {
        try {
            $params = $this->toValidate($request);

            $order = $this->orderService->store($params);

            return $this->sendJsonSuccessResponse('Pedido cadastrado com sucesso!', $order);
        } catch (ClientNotFoundException | ProductNotFoundException $e) {
            return $this->sendJsonErrorResponse($e);
        }
    }

    public function edit(int $id)
    {
        try {
            $order = $this->orderService->edit($id);

            return $this->sendJsonSuccessResponse('Dados do pedido encontrados!', $order);
        } catch (OrderNotFoundException $e) {
            return $this->sendJsonErrorResponse($e);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $params = $this->toValidate($request, true);

            $order = $this->orderService->update($params, $id);

            return $this->sendJsonSuccessResponse('Dados do pedido atualizados com sucesso!', $order);
        } catch (
            ClientNotFoundException |
            OrderNotFoundException | 
            ProductNotFoundException $e
        ) {
            return $this->sendJsonErrorResponse($e);
        }
    }

    public function delete(int $id)
    {
        try {
            $this->orderService->delete($id);

            return $this->sendJsonSuccessResponse('Pedido excluído com sucesso!');
        } catch (OrderNotFoundException $e) {
            return $this->sendJsonErrorResponse($e);
        }
    }

    protected function toValidate(Request $request, bool $isUpdate = false)
    {
        $itemsField = $isUpdate ? 'nullable' : 'required';

        return $this->validate($request, [
            'id_client' => 'required|numeric',
            'items' => $itemsField . '|array'
        ]);
    }
}
