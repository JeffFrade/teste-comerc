<?php

namespace Tests\Unit\Services;

use App\Exceptions\ClientNotFoundException;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Pagination\Paginator;
use Tests\TestCase;

class ClientServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $clientService;

    public function setUp(): void
    {
        parent::setUp();
        $this->clientService = new ClientService();
    }

    public function testIndexClient(): void
    {
        $clients = $this->clientService->index([
            'search' => 'a'
        ]);

        $this->assertNotEmpty($clients);
        $this->assertGreaterThanOrEqual(1, $clients->count());
    }

    public function testWrongIndexClient(): void
    {
        $this->expectException(ClientNotFoundException::class);

        $this->clientService->index([
            'search' => 'aaaaaaaaaaaaaaa'
        ]);
    }

    public function testStoreClient(): void
    {
        $client = $this->storeClient();

        $this->assertInstanceOf(Client::class, $client);
        $this->assertNotEmpty($client);
        $this->assertEquals('test@mail.com', $client->email);
    }

    public function testEditClient(): void
    {
        $client = $this->storeClient();
        $client = $this->clientService->edit($client->id);

        $this->assertInstanceOf(Client::class, $client);
        $this->assertNotEmpty($client);
        $this->assertEquals('2001-01-01', $client->birth_date);
    }

    public function testWrongEditClient(): void
    {
        $this->expectException(ClientNotFoundException::class);

        $id = 0;
        $this->clientService->edit($id);
    }

    public function testUpdateClient(): void
    {
        $client = $this->storeClient();

        $this->clientService->update([
            'number' => 12
        ], $client->id);

        $client = $this->clientService->edit($client->id);

        $this->assertInstanceOf(Client::class, $client);
        $this->assertNotEmpty($client);
        $this->assertEquals(12, $client->number);
    }

    public function testDeleteClient(): void
    {
        $this->expectException(ClientNotFoundException::class);

        $client = $this->storeClient();
        $this->clientService->delete($client->id);
        $this->clientService->edit($client->id);
    }

    private function storeClient(): Client
    {
        return $this->clientService->store([
            'name' => 'Test',
            'email' => 'test@mail.com',
            'phone' => '987654321',
            'birth_date' => '2001-01-01',
            'cep' => '12345678',
            'address' => 'Rua do Teste',
            'number' => 123,
            'complement' => null,
            'neighborhood' => 'Testelândia'
        ]);
    }
}