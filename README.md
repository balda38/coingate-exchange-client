# coingate-exchange-client
Client for getting data about currencies exchange rates from https://coingate.com

**This library works with Coingate API v2!**

For more details go to https://developer.coingate.com/docs/api-overview

# Usage:

1. Init you client:
```
$client = new Balda38\CoingateExchangeClient\Client();
```
2. Get data from Coingate API:
    * get Coingate supported currencies list:
    ```
        $client->getCurrencies();
    ```
    * get Coingate currencies exchange rates:
    ```
        $client->getExchangeRates();
    ```

The library returns data from Coingate API as an array.
