<?php

namespace Yasiekz\RouterBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Yasiekz\RouterBundle\Service\Router;
use Yasiekz\RouterBundle\Tests\Functional\Model\RouterBadTestClass;
use Yasiekz\RouterBundle\Tests\Functional\Model\RouterCmsTestClass;
use Yasiekz\RouterBundle\Tests\Functional\Model\RouterFrontTestClass;
use Yasiekz\RouterBundle\Tests\Functional\Model\RouterMultiFrontTestClass;

/**
 * Class RouterTest
 * @package Yasiekz\RouterBundle\Tests\Service
 */
class RouterTest extends KernelTestCase
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @return array
     */
    public function stringProvider()
    {
        return [
            ['cms_test_edit', ['id' => 2], true, 'http://localhost/test,2'],
            ['cms_test_edit', ['id' => 2], false, '/test,2']
        ];
    }

    /**
     * @return array
     */
    public function badObjectProvider()
    {
        return [
            [new RouterBadTestClass(1), ['param1' => 'value1']],
            [new RouterBadTestClass(2)],
        ];
    }

    /**
     * @return array
     */
    public function frontProvider()
    {
        return [
            [new RouterFrontTestClass(1), [], true, 'http://localhost/test-front/1'], // test without any params with an empty array
            [new RouterFrontTestClass(2), array(), false, '/test-front/2'], // test without any params without parameters value
            [new RouterFrontTestClass(3), ['param1' => 'value1', 'param2' => 'value2'], false, '/test-front/3,value1,value2'], // test with additional params
        ];
    }

    /**
     * @return array
     */
    public function cmsProvider()
    {
        return [
            [new RouterCmsTestClass(1), 'edit', true, 'http://localhost/test,1'],
            [new RouterCmsTestClass(2), 'delete', false, '/test-cms,2'],
        ];
    }

    /**
     * @return array
     */
    public function multiFrontProvider()
    {
        return [
            [new RouterMultiFrontTestClass(1), ['destination' => 'article'], true, 'http://localhost/test-multi-front/1'], // test without any params with an empty array
            [new RouterMultiFrontTestClass(2), ['destination' => 'article', 'param1' => 'value1'], true, 'http://localhost/test-multi-front/2,value1'], // test without any params with an empty array
            [new RouterMultiFrontTestClass(3), ['param1' => 'value1', 'param2' => 'value2'], false, '/test-front/3,value1,value2'], // test with additional params
        ];
    }

    /**
     *
     */
    protected function setUp()
    {
        self::bootKernel();
        $this->router = static::$kernel->getContainer()->get('router');

        parent::setUp();
    }

    /**
     * @dataProvider frontProvider
     * @param      $routeName
     * @param      $parameters
     * @param null $absolute
     * @param      $expectedValue
     * @throws \Exception
     */
    public function testGenerateFront($routeName, $parameters = array(), $absolute = null, $expectedValue)
    {
        $routeUrl = $this->router->generate($routeName, $parameters, $absolute);
        $this->assertEquals($routeUrl, $expectedValue);
    }

    /**
     * @dataProvider cmsProvider
     * @param      $routeName
     * @param      $destination
     * @param null $absolute
     * @param      $expectedValue
     * @throws \Exception
     */
    public function testGenerateCms($routeName, $destination, $absolute = null, $expectedValue)
    {
        $routeUrl = $this->router->generate($routeName, $destination, $absolute);
        $this->assertEquals($routeUrl, $expectedValue);
    }

    /**
     * @dataProvider stringProvider
     * @param $routeName
     * @param $parameters
     * @param $absolute
     * @param $expectedValue
     * @throws \Exception
     */
    public function testGenerateString($routeName, $parameters, $absolute, $expectedValue)
    {
        $this->assertEquals($this->router->generate($routeName, $parameters, $absolute), $expectedValue);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider badObjectProvider
     * @param      $routeObject
     * @param null $parameters
     * @throws \Exception
     */
    public function testGenerateBadObject($routeObject, $parameters = null)
    {
        $this->setExpectedException(
            'Exception',
            'Object of class Yasiekz\RouterBundle\Tests\Functional\Model\RouterBadTestClass does not implement RoutableInterface'
        );
        $this->router->generate($routeObject, $parameters, true);
    }

    /**
     *
     */
    public function testInitialize()
    {
        $this->assertInstanceOf('Yasiekz\RouterBundle\Service\Router', $this->router);
    }

}
