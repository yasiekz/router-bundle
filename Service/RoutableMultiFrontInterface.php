<?php

namespace Yasiekz\RouterBundle\Service;

/**
 * Interface RoutableMultiFrontInterface
 * @package Cms\BaseBundle\Routing
 */
interface RoutableMultiFrontInterface extends RoutableInterface
{
    /**
     * @param array $parameters
     * @param null $destination
     * @return mixed
     */
    public function getRouteName($parameters = array(), $destination = null);
}
