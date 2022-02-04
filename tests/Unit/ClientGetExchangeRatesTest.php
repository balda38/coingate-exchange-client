<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use Balda38\CoingateExchangeClient\Client;

use function is_array;

class ClientGetExchangeRatesTest extends TestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        $this->client = new Client();
    }

    public function tearDown()
    {
        $this->client = null;
    }

    public function testGetCurrencies()
    {
        $exchangeRates = $this->client->getExchangeRates();

        $this->assertTrue(is_array($exchangeRates));
        foreach ($exchangeRates as $currencyRates) {
            $this->assertGreaterThan(0, (count($currencyRates)));
        }
    }
}
