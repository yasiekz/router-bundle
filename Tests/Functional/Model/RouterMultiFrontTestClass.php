<?php

namespace Yasiekz\RouterBundle\Tests\Functional\Model;

use Yasiekz\RouterBundle\Service\RoutableMultiFrontInterface;

/**
 * Class RouterMultiFrontTestClass
 * @package Yasiekz\RouterBundle\Tests\Functional\Model
 */
class RouterMultiFrontTestClass implements RoutableMultiFrontInterface
{
    const DESTINATION_ARTICLE = 'article';

    /**
     * @var int
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $routeName
     * @param null $destination
     * @return array
     */
    public function getRouterParameters($routeName, $destination = null)
    {
        return [
            'id' => $this->getId()
        ];
    }

    /**
     * @param array $parameters
     * @param null $destination
     * @return mixed
     */
    public function getRouteName($parameters = array(), $destination = null)
    {
        if (self::DESTINATION_ARTICLE == $destination) {
            return 'cms_multi-front_test';
        }
        return 'cms_front_test';
    }
}
