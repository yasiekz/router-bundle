<?php

namespace Yasiekz\RouterBundle\Strategy;

use Yasiekz\RouterBundle\Service\RoutableFrontInterface;
use Yasiekz\RouterBundle\Service\RoutableMultiFrontInterface;

/**
 * Class MultiFrontStrategy
 * @package Yasiekz\RouterBundle\Strategy
 * @author Jan Zieba <yasiekz@gmail.com>
 */
class MultiFrontStrategy implements StrategyInterface
{
    /**
     * @var RoutableMultiFrontInterface
     */
    private $object;

    /**
     * @param RoutableMultiFrontInterface $object
     * @param                   $parameters
     * @return array
     */
    public function generate($object, $parameters)
    {
        $this->setObject($object);
        $destination = isset($parameters['destination']) ? $parameters['destination'] : null;
        unset($parameters['destination']);;
        $routeName = $this->object->getRouteName($parameters, $destination);
        $routeParameters = array_merge($object->getRouterParameters($routeName), $parameters);

        return array($routeName, $routeParameters);
    }

    /**
     * @param RoutableMultiFrontInterface $object
     */
    public function setObject(RoutableMultiFrontInterface $object)
    {
        $this->object = $object;
    }
}
