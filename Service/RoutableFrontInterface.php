<?php

namespace Yasiekz\RouterBundle\Service;

/**
 * Interface RouterInterface
 * @package Cms\BaseBundle\Routing
 */
interface RoutableFrontInterface extends RoutableInterface
{
    /**
     * Pobiera nazwe routingu w zaleznosci od parametrow obiektu
     *
     * @return mixed
     */
    public function getRouteName();
}
