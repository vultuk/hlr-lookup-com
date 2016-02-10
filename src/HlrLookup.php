<?php namespace Vultuk\HlrLookup;

use Vultuk\HlrLookup\Parsers\SingleNumberParse;

class HlrLookup
{
    protected $apiKey = null;

    protected $password = null;

    public function __construct($apiKey = null, $password = null)
    {
        $this->apiKey = $apiKey;
        $this->password = $password;
    }

    public function hasCredit()
    {
        return true;
    }


    protected function check($items)
    {
        // Run the API call to Lookup the information
        $remote = new Remote($this->apiKey, $this->password);
        $response = $remote->hlr($items);

        // Parse the details into the correct class
        if (!is_array($items)) {
            $parsedResult = SingleNumberParse::parse($response);
        }

        // Return the results
        return $parsedResult;
    }


    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function __call($method, $arguments)
    {
        switch($method) {
            case "apiKey":
                return $this->setApiKey($arguments[0]);
                break;
            case "password":
                return $this->setPassword($arguments[0]);
                break;
            case "number":
                return $this->check($arguments[0]);
                break;
            case "numbers":
                if (!is_array($arguments[0])) {
                    throw new \InvalidArgumentException('Argument should be of type Array');
                }
                return $this->check($arguments[0]);
                break;
            default:
                throw new \BadMethodCallException("No static Method {$method} is available.");
                break;
        }
    }

    public static function __callStatic($method, $arguments)
    {
        $hlrLookup = new HlrLookup();
        switch($method) {
            case "apiKey":
                return $hlrLookup->setApiKey($arguments[0]);
                break;
            case "password":
                return $hlrLookup->setPassword($arguments[0]);
                break;
            case "number":
                return $hlrLookup->check($arguments[0]);
                break;
            case "numbers":
                if (!is_array($arguments[0])) {
                    throw new \InvalidArgumentException('Argument should be of type Array');
                }
                return $hlrLookup->check($arguments[0]);
                break;
            default:
                throw new \BadMethodCallException("No static Method {$method} is available.");
                break;
        }
    }

}