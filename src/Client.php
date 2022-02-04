<?php

namespace Balda38\CoingateExchangeClient;

use Balda38\CoingateExchangeClient\Exceptions\CoingateAPIConnectionException;
use Balda38\CoingateExchangeClient\Exceptions\CoingateAPIUnknownResponseException;

use function curl_init;
use function curl_setopt;
use function curl_exec;
use function curl_close;
use function json_decode;
use function is_array;

class Client
{
    const COINGATE_API_URL = 'https://api.coingate.com/v2';

    public function getCurrencies() : array
    {
        return $this->getData('/currencies');
    }

    public function getExchangeRates() : array
    {
        return $this->getData('/rates/merchant');
    }

    /**
     * @throws CoingateAPIConnectionException
     * @throws CoingateAPIUnknownResponseException
     */
    protected function getData(string $endPoint) : array
    {
        $curl = curl_init(static::COINGATE_API_URL.$endPoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if (!($data = curl_exec($curl))) {
            curl_close($curl);

            throw new CoingateAPIConnectionException('Failed to connect to Coingate API');
        }
        curl_close($curl);

        $data = json_decode($data, true);
        if (!is_array($data)) {
            throw new CoingateAPIUnknownResponseException('Unknown Coingate API response');
        }

        return $data;
    }
}
