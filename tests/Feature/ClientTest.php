<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use Balda38\CoingateExchangeClient\Client;

use Balda38\CoingateExchangeClient\Exceptions\CoingateAPIConnectionException;
use Balda38\CoingateExchangeClient\Exceptions\CoingateAPIUnknownResponseException;

use Tests\Stubs\ClientStub;

use function is_array;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var ClientStub
     */
    protected $clientStub;

    public function setUp()
    {
        $this->client = new Client();
        $this->clientStub = new ClientStub();
    }

    public function tearDown()
    {
        $this->client = null;
    }

    private function mockGetDataFunction(string $endPoint, bool $useStub = false)
    {
        $cb = function () use ($endPoint) {
            return $this->getData($endPoint);
        };

        return $cb->call($useStub ? $this->clientStub : $this->client);
    }

    public function testGetData()
    {
        $data = $this->mockGetDataFunction('/currencies');
        $this->assertTrue(is_array($data));
    }

    public function testGetDataConnectionException()
    {
        $this->expectException(CoingateAPIConnectionException::class);
        $this->mockGetDataFunction('/currencies', true);
    }

    public function testGetDataUnknownResponseException()
    {
        $this->expectException(CoingateAPIUnknownResponseException::class);
        $this->mockGetDataFunction('/some-other-endpoint');
    }
}
