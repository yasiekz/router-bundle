<?php

use Yasiekz\RouterBundle\Service\Router;
use Yasiekz\RouterBundle\Strategy\CmsStrategy;
use Yasiekz\RouterBundle\Tests\Functional\Model\RouterCmsTestClass;

/**
 * Class CmsStrategyTest
 */
class CmsStrategyTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{
    /**
     * @var CmsStrategy;
     */
    private $strategy;

    /**
     *
     */
    protected function setUp()
    {
        $this->strategy = new \Yasiekz\RouterBundle\Strategy\CmsStrategy();
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [new RouterCmsTestClass(1), 'edit', 'cms_test_edit'],
            [new RouterCmsTestClass(2), 'delete', 'cms_test_delete'],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param RouterCmsTestClass $object
     * @param                    $destination
     * @param null               $expectedRouteName
     * @throws Exception
     */
    public function testGenerate($object, $destination, $expectedRouteName = null)
    {
        if ($expectedRouteName) {
            $result = $this->strategy->generate($object, $destination);
            $this->assertEquals($result[0], $expectedRouteName);
            $this->assertEquals($result[1], ['id' => $object->getId()]);
        } else {
            $this->setExpectedException('Exception');
            $result = $this->strategy->generate($object, $destination); // ma rzucic wyjatkiem
        }
    }
}
