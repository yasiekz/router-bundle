<?php

use Yasiekz\RouterBundle\Strategy\MultiFrontStrategy;
use Yasiekz\RouterBundle\Tests\Functional\Model\RouterFrontTestClass;
use Yasiekz\RouterBundle\Tests\Functional\Model\RouterMultiFrontTestClass;

/**
 * Class FrontStrategyTest
 */
class MultiFrontStrategyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MultiFrontStrategy;
     */
    private $strategy;

    /**
     *
     */
    protected function setUp()
    {
        $this->strategy = new \Yasiekz\RouterBundle\Strategy\MultiFrontStrategy();
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [new RouterMultiFrontTestClass(1), []], // test without any params with an empty array
            [new RouterMultiFrontTestClass(2)], // test without any params without parameters value
            [new RouterMultiFrontTestClass(3), ['param1' => 'value1', 'param2' => 'value2']], // test with additional params
            [new RouterMultiFrontTestClass(4), ['destination' => 'article', 'param1' => 'value1', 'param2' => 'value2'], 'article'], // test with additional params and destination
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param RouterMultiFrontTestClass $object
     * @param                      $parameters
     * @throws Exception
     */
    public function testGenerate($object, $parameters = array(), $destination = null)
    {
        $result = $this->strategy->generate($object, $parameters);
        unset($parameters['destination']);
        $this->assertEquals($result[0], $object->getRouteName($parameters, $destination));
        $this->assertEquals($result[1], array_merge($parameters, ['id' => $object->getId()]));
    }
}
