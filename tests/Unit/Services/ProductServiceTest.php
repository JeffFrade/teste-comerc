<?php

namespace Tests\Unit\Services;

use App\Exceptions\ProductNotFoundException;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Unit\Mocks\UploadedFileMock;

class ProductServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $productService;

    public function setUp(): void
    {
        parent::setUp();
        $this->productService = new ProductService();
    }

    public function testIndexProduct(): void
    {
        $clients = $this->productService->index([
            'search' => 'a'
        ]);

        $this->assertNotEmpty($clients);
        $this->assertGreaterThanOrEqual(1, $clients->count());
    }

    public function testWrongIndexProduct(): void
    {
        $this->expectException(ProductNotFoundException::class);

        $this->productService->index([
            'search' => 'aaaaaaaaaaaaaaa'
        ]);
    }

    public function testStoreProduct(): void
    {
        $product = $this->storeProduct();

        $this->assertInstanceOf(Product::class, $product);
        $this->assertNotEmpty($product);
        $this->assertEquals('Test', $product->name);
    }

    public function testEditProduct(): void
    {
        $product = $this->storeProduct();
        $product = $this->productService->edit($product->id);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertNotEmpty($product);
        $this->assertEquals('Test', $product->name);
    }

    public function testWrongEditProduct(): void
    {
        $this->expectException(ProductNotFoundException::class);

        $id = 0;
        $this->productService->edit($id);
    }

    public function testUpdateProduct(): void
    {
        $product = $this->storeProduct();
        $file = new UploadedFileMock();

        $this->productService->update([
            'name' => 'Test 123',
            'photo' => $file->getMock()
        ], $product->id);

        $product = $this->productService->edit($product->id);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertNotEmpty($product);
        $this->assertEquals('Test 123', $product->name);
    }

    public function testDeleteProduct(): void
    {
        $this->expectException(ProductNotFoundException::class);

        $client = $this->storeProduct();
        $this->productService->delete($client->id);
        $this->productService->edit($client->id);
    }

    private function storeProduct()
    {
        $file = new UploadedFileMock();

        return $this->productService->store([
            'name' => 'Test',
            'price' => 3.7,
            'photo' => $file->getMock()
        ]);
    }
}