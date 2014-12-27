<?php

namespace Yasiekz\RouterBundle\Strategy;

use Yasiekz\RouterBundle\Service\RoutableInterface;

/**
 * Interface StrategyInterface
 * @package Yasiekz\RouterBundle\Strategy
 * @author Jan Zieba <yasiekz@gmail.com>
 */
interface StrategyInterface
{
    /**
     * @param RoutableInterface $object
     * @param              $parameters
     * @return mixed
     */
    public function generate($object, $parameters);
} 
