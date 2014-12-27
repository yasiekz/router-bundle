<?php

class YasiekzRouterBundleTest extends PHPUnit_Framework_TestCase
{
    public function testBundle()
    {
        $this->assertInstanceOf('Yasiekz\RouterBundle\YasiekzRouterBundle', new \Yasiekz\RouterBundle\YasiekzRouterBundle());
    }
}
