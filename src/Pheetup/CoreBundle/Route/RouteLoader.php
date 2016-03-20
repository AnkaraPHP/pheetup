<?php
/**
 * pheetup
 * User: emreyilmaz
 */

namespace Pheetup\CoreBundle\Route;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class RouteLoader implements LoaderInterface
{
    /** @var  EntityManager */
    private $em;

    /** @var  RouteCollection */
    private $routes;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->routes = new RouteCollection();
    }

    private $loaded = false;


    const DEFAULT_PREFIX = "/";

    /**
     * @inheritDoc
     */
    public function load($resource, $type = null)
    {
        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add this loader twice');
        }
        $entities = [];
        $meta = $this->em->getMetadataFactory()->getAllMetadata();
        foreach ($meta as $m) {
            if (strstr($m->getName(), 'Pheetup'))
                $entities[] = $m->getName();
        }

        foreach ($entities as $entity) {
            $this->createRoutes($entity);
        }

        return $this->routes;
    }

    private function createRoutes($entity)
    {
        $prefix = self::DEFAULT_PREFIX;
        $parts = explode('\\', $entity);
        $bundle = str_replace('bundle','',strtolower($parts[1]));
        $routeKey = strtolower($parts[3]);
        $controller =  strtolower($parts[3]);
        // pheetup.controller.bundle.controller
        $controller_service = 'pheetup.controller.'.$bundle.'.'.$controller;
        //create
        $createPattern = $prefix . '/' . $routeKey . '/create/{id}';
        $createDefaults = [
            '_controller' => $controller_service. ':createAction',
            'id'=>0
        ];
        $createRoute = new Route($createPattern, $createDefaults);
        $this->routes->add('pheetup_' . $routeKey . '_create', $createRoute);

        //list
        $listPattern = $prefix . '/' . $routeKey;
        $listDefaults = [
            '_controller' => $controller_service . ':listAction'
        ];
        $listRoute = new Route($listPattern, $listDefaults);
        $this->routes->add('pheetup_' . $routeKey, $listRoute);


        //delete
        $deletePattern = $prefix . '/' . $routeKey . '/delete/{id}';
        $deleteDefaults = [
            '_controller' => $controller_service . ':deleteAction',
        ];
        $deleteRoute = new Route($deletePattern, $deleteDefaults, [
            'id' => '\d+'
        ]);
        $this->routes->add('pheetup_' . $routeKey . '_delete', $deleteRoute);


        //view
        $viewPattern = $prefix.'/'.$routeKey.'/explore/{id}';
        $viewDefaults = [
            '_controller' => $controller_service.':viewAction',
        ];
        $viewRoute = new Route(
            $viewPattern, $viewDefaults, [
                'id' => '\d+',
            ]
        );
        $this->routes->add('pheetup_'.$routeKey.'_view', $viewRoute);
    }

    /**
     * @inheritDoc
     */
    public function supports($resource, $type = null)
    {
        return "extra" === $type;
    }

    /**
     * @inheritDoc
     */
    public function getResolver()
    {
        // TODO: Implement getResolver() method.
    }

    /**
     * @inheritDoc
     */
    public function setResolver(LoaderResolverInterface $resolver)
    {
        // TODO: Implement setResolver() method.
    }

}