<?php

namespace Yasiekz\RouterBundle\Service;

use Symfony\Bundle\FrameworkBundle\Routing\Router as BaseRouter;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Yasiekz\RouterBundle\Strategy\StrategyInterface;

/**
 * Klasa pozwalajaca obiektorm wiedziec jakie maja adresy do edycji / usuwania / czegokolwiek waznego
 * Class Router
 * @package Cms\BaseBundle\Routing
 */
class Router extends BaseRouter
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * @param mixed                                                     $resource
     * @param array                                                     $options
     * @param \Symfony\Component\Routing\RequestContext                 $context
     * @internal param \Symfony\Component\HttpKernel\Log\LoggerInterface $logger
     */
    public function __construct(ContainerInterface $container, $resource, array $options = array(), RequestContext $context = null)
    {
        $this->container = $container;
        parent::__construct($container, $resource, $options, $context);
    }


    /**
     * Generates a URL from the given parameters.
     *
     * @param string  $routeName
     * @param mixed   $parameters An array of parameters
     * @param Boolean $absolute Whether to generate an absolute URL
     *
     * @throws \Exception
     * @internal param string $name The name of the route
     * @return string The generated URL
     *
     */
    function generate($routeName, $parameters = array(), $absolute = false)
    {
        if ($routeName instanceof ContainerAwareInterface) {
            $routeName->setContainer($this->container);
        }

        $strategy = null;
        switch (true) {
            case $routeName instanceof RoutableCmsInterface:
                $strategy = $this->getCmsStrategyService();
                break;
            case $routeName instanceof RoutableFrontInterface:
                $strategy = $this->getFrontStrategyService();
        }

        if ($strategy instanceof StrategyInterface) {
            list($routeName, $parameters) = $strategy->generate($routeName, $parameters);
        }

        if (is_object($routeName)) {
            throw new \Exception('Object of class ' . get_class($routeName) . ' does not implement RoutableInterface');
        }

        return parent::generate($routeName, $parameters, $absolute);
    }

    /**
     * @return StrategyInterface
     */
    private function getCmsStrategyService()
    {
        return $this->container->get('yasiekz_router.router.strategy.cms');
    }

    /**
     * @return StrategyInterface
     */
    private function getFrontStrategyService()
    {
        return $this->container->get('yasiekz_router.router.strategy.front');
    }

}
