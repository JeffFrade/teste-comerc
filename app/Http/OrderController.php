<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Exceptions\OrderNotFoundException;
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
}
