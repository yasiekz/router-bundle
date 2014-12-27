<?php

namespace Yasiekz\RouterBundle\Service;


/**
 * Interface RouterInterface
 * @package Cms\BaseBundle\Routing
 */
interface RoutableCmsInterface extends RoutableInterface
{
    /**
     * Pobiera mozliwe cele routingu w danym obiekcie
     *
     * @return mixed
     */
    public function getPossibleRoutes();
}
