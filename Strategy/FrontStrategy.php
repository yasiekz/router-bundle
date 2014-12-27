<?php

namespace Yasiekz\RouterBundle\Strategy;

use Yasiekz\RouterBundle\Service\RoutableFrontInterface;

/**
 * Class FrontStrategy
 * @package Yasiekz\RouterBundle\Strategy
 * @author Jan Zieba <yasiekz@gmail.com>
 */
class FrontStrategy implements StrategyInterface
{
    /**
     * @var RoutableFrontInterface
     */
    private $object;

    /**
     * @param RoutableFrontInterface $object
     * @param                   $parameters
     * @return array
     */
    public function generate($object, $parameters)
    {
        $this->setObject($object);
        $routeName = $this->object->getRouteName();
        $routeParameters = array_merge($object->getRouterParameters($routeName), $parameters);

        return array($routeName, $routeParameters);
    }

    /**
     * @param RoutableFrontInterface $object
     */
    public function setObject(RoutableFrontInterface $object)
    {
        $this->object = $object;
    }
}
