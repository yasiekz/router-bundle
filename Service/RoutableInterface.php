<?php

namespace Yasiekz\RouterBundle\Service;


/**
 * Interface RouterInterface
 * @package Cms\BaseBundle\Routing
 */
interface RoutableInterface
{
    /**
     * Pobiera parametry do routingu
     *
     * @param string $routeName
     * @param null $destination
     * @return array
     */
    public function getRouterParameters($routeName, $destination = null);
}
