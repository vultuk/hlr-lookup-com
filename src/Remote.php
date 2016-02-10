<?php namespace Vultuk\HlrLookup;

use GuzzleHttp\Client;
use Vultuk\HlrLookup\Exceptions\InvalidApiKeyOrPasswordException;

class Remote
{

    protected $endpoint  = 'https://www.hlrlookup.com/api/';

    protected $apiKey = null;

    protected $password = null;

    public function __construct($apiKey, $password)
    {
        $this->apiKey = $apiKey;
        $this->password = $password;
    }

    public function hlr($numbers)
    {
        $numbers = is_array($numbers) ? implode(',', $numbers) : $numbers;

        $result = $this->connect('hlr', [
            'msisdn' => $numbers,
        ]);

        return $result;
    }

    protected function connect($type, $options = [])
    {
        $query = http_build_query(array_merge([
            'apikey' => $this->apiKey,
            'password' => $this->password
        ], $options));


        $client = new Client();
        $response = $client
            ->request('GET', $this->endpoint . $type . '/?' . $query);

        $result = json_decode($response->getBody(), true);

        if (isset($result['ERR']) && $result['ERR'] === "Could not authenticate") {
            throw new InvalidApiKeyOrPasswordException("Could not authenticate, Invalid API Key or Password.");
        }

        return $result;
    }

}