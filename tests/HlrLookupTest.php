<?php

use Vultuk\HlrLookup\HlrLookup;

class HlrLookupTest extends PHPUnit_Framework_TestCase
{
    public function testHasCredit()
    {
        $hlrLookup = new HlrLookup();
        $this->assertTrue($hlrLookup->hasCredit());
    }

    public function testNumber()
    {
        $hlrLookup = new HlrLookup('', '');
        $response = $hlrLookup->number('07949834768');

        var_dump($response->isActive());
    }

}