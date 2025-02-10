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

    public function store(Request $request)
    {
        $params = $this->toValidate($request);
        $product = $this->productService->store($params);

        return $this->sendJsonSuccessResponse('Produto cadastrado com sucesso!', $product);
    }

    public function edit(int $id)
    {
        try {
            $product = $this->productService->edit($id);

            return $this->sendJsonSuccessResponse('Dados do produto encontrados!', $product);
        } catch (ProductNotFoundException $e) {
            return $this->sendJsonErrorResponse($e);
        }
    }

    protected function toValidate(Request $request, bool $isUpdate = false)
    {
        $photoField = $isUpdate ? 'nullable' : 'required';

        return $this->validate($request, [
            'name' => 'required|max:75',
            'price' => 'required|numeric',
            'photo' => $photoField . '|file',
        ]);
    }
}
