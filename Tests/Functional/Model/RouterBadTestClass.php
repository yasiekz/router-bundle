<?php

namespace Yasiekz\RouterBundle\Tests\Functional\Model;


class RouterBadTestClass
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

}
