<?php
/**
 * pheetup
 * User: emreyilmaz
 */

namespace Pheetup\CoreBundle\Tests\Controller;


use Pheetup\CoreBundle\Controller\CrudController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ControllerTestCase extends WebTestCase
{
    /** @var  string */
    private $enviroment = 'test';

    /** @var \Symfony\Component\DependencyInjection\ContainerInterface */
    protected $container;
    /** @var  CrudController */
    protected $controller;

    public function __construct( $name = NULL, array $data = [ ], $dataName = "" )
    {
        parent::__construct( $name, $data, $dataName );
        if ( !static::$kernel )
        {
            static::$kernel = self::createKernel( [
                                                      'environment' => $this->enviroment,
                                                      'debug'       => TRUE,
                                                  ] );
            static::$kernel->boot();
        }

        $this->container = self::$kernel->getContainer();
    }

    public function setController( $name )
    {
        $this->controller = $this->container->get( 'pheetup.controller.' . $name );

        return $this;
    }
}
