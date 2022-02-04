<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use Balda38\CoingateExchangeClient\Client;

use function is_array;

class ClientGetCurrenciesTest extends TestCase
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
        $currencies = $this->client->getCurrencies();

        $this->assertTrue(is_array($currencies));
        foreach ($currencies as $currency) {
            $this->assertArrayHasKey('title', $currency);
            $this->assertArrayHasKey('symbol', $currency);
            $this->assertArrayHasKey('native', $currency);
            $this->assertArrayHasKey('kind', $currency);
            $this->assertArrayHasKey('disabled', $currency);
            $this->assertArrayHasKey('disabled_message', $currency);
            $this->assertArrayHasKey('merchant', $currency);
            $this->assertArrayHasKey('price', $currency['merchant']);
            $this->assertArrayHasKey('pay', $currency['merchant']);
            $this->assertArrayHasKey('receive', $currency['merchant']);
        }
    }
}
