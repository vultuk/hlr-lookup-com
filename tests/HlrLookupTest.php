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
        $hlrLookup = new HlrLookup('7V7AdGLWLhJmsbQ4KK4cdwJYGn6kXJIU', 'Wvts231ct6D');
        $response = $hlrLookup->number('447949834768');

        var_dump($response->isActive());
    }

}