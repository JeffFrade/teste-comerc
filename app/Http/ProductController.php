<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Exceptions\ProductNotFoundException;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        try {
            $params = $request->all();

            $products = $this->productService->index($params);

            return $this->sendJsonSuccessResponse('Dados encontrados!', $products);
        } catch (ProductNotFoundException $e) {
            return $this->sendJsonErrorResponse($e);
        }
    }
}
