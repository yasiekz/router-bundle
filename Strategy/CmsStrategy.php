<?php

namespace Yasiekz\RouterBundle\Strategy;


use Yasiekz\RouterBundle\Service\RoutableCmsInterface;
use Yasiekz\RouterBundle\Service\RoutableInterface;

/**
 * Class CmsStrategy
 * @package Yasiekz\RouterBundle\Strategy
 */
class CmsStrategy implements StrategyInterface
{
    /**
     * @var RoutableCmsInterface
     */
    private $object;

    /**
     * @param RoutableCmsInterface $object
     * @param                      $destination
     * @return array
     * @throws \Exception
     */
    public function generate($object, $destination)
    {
        $this->setObject($object);
        if (empty($destination)) {
            throw new \Exception('The destination parameter must be set while routeName is an object');
        }

        $possibleRoutes = $this->object->getPossibleRoutes();
        if (!array_key_exists($destination, $possibleRoutes)) {
            throw new \Exception('The destination ' . $destination . ' is not supported for object ' . get_class($object));
        }
        $routeName = $possibleRoutes[$destination];
        $routeParameters = $this->object->getRouterParameters($routeName, $destination);

        return array($routeName, $routeParameters);
    }

    /**
     * @param RoutableCmsInterface $object
     */
    private function setObject(RoutableCmsInterface $object)
    {
        $this->object = $object;
    }
}
