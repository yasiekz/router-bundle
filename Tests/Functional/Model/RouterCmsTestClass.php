<?php

namespace Yasiekz\RouterBundle\Tests\Functional\Model;

use Yasiekz\RouterBundle\Service\RoutableCmsInterface;

class RouterCmsTestClass implements RoutableCmsInterface
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
     * Pobiera mozliwe cele routingu w danym obiekcie
     *
     * @return mixed
     */
    public function getPossibleRoutes()
    {
        return [
            'edit' => 'cms_test_edit',
            'delete' => 'cms_test_delete'
        ];
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
}
