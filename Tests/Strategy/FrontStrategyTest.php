<?php

use Yasiekz\RouterBundle\Strategy\FrontStrategy;
use Yasiekz\RouterBundle\Tests\Functional\Model\RouterFrontTestClass;

/**
 * Class FrontStrategyTest
 */
class FrontStrategyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FrontStrategy;
     */
    private $strategy;

    /**
     *
     */
    protected function setUp()
    {
        $this->strategy = new \Yasiekz\RouterBundle\Strategy\FrontStrategy();
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [new RouterFrontTestClass(1), []], // test without any params with an empty array
            [new RouterFrontTestClass(2)], // test without any params without parameters value
            [new RouterFrontTestClass(3), ['param1' => 'value1', 'param2' => 'value2']], // test with additional params
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param RouterFrontTestClass $object
     * @param                      $parameters
     * @throws Exception
     */
    public function testGenerate($object, $parameters = array())
    {
        $result = $this->strategy->generate($object, $parameters);
        $this->assertEquals($result[0], $object->getRouteName());
        $this->assertEquals($result[1], array_merge($parameters, ['id' => $object->getId()]));
    }
}
