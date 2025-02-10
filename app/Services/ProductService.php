<?php

namespace App\Services;

use App\Exceptions\ProductNotFoundException;
use App\Helpers\FileHelper;
use App\Repositories\ProductRespository;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

class ProductService
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRespository();
    }

    public function index(array $data)
    {
        $search = $data['search'] ?? '';

        $products = $this->productRepository->index($search);

        if ($products->isEmpty()) {
            throw new ProductNotFoundException('Não há produtos para os critérios informados.');
        }

        return $products;
    }

    public function store(array $data)
    {
        $data['photo'] = $this->storePhoto($data['photo']);

        return $this->productRepository->create($data);
    }

    public function edit(int $id)
    {
        $product = $this->productRepository->findFirst('id', $id);

        if (empty($product)) {
            throw new ProductNotFoundException('Produto inexistente.');
        }

        return $product;
    }

    public function update(array $data, int $id)
    {
        $this->edit($id);
        
        if (!empty($data['photo'] ?? '')) {
            $data['photo'] = $this->storePhoto($data['photo']);
        }

        $this->productRepository->update($data, $id);
    }

    private function storePhoto(UploadedFile $file)
    {
        $filename = Carbon::now()->format('YmdHis-') . $file->getClientOriginalName();
        $filename = FileHelper::writeArchive($file, $filename);
        
        return FileHelper::getArchiveUrl($filename);
    }
}
