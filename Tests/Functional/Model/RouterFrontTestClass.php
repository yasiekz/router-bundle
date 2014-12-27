<?php

namespace Yasiekz\RouterBundle\Tests\Functional\Model;

use Yasiekz\RouterBundle\Service\RoutableCmsInterface;
use Yasiekz\RouterBundle\Service\RoutableFrontInterface;

class RouterFrontTestClass implements RoutableFrontInterface
{
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Pobiera parametry do routingu
     *
     * @param string $routeName
     * @param null   $destination
     * @return array
     */
    public function getRouterParameters($routeName, $destination = null)
    {
        return [
            'id' => $this->getId()
        ];
    }

    /**
     * Pobiera nazwe routingu w zaleznosci od parametrow obiektu
     *
     * @return mixed
     */
    public function getRouteName()
    {
        return 'cms_front_test';
    }
}
