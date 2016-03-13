<?php
/**
 * pheetup
 * User: emreyilmaz
 */

namespace Pheetup\CoreBundle\Tests\Repository;


use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class DoctrineTestCase
 *
 * @package Pheetup\CoreBundle\Test\Repository
 */
class DoctrineTestCase extends WebTestCase
{
    /** @var \Symfony\Component\DependencyInjection\ContainerInterface */
    protected $container;
    protected $em;
    protected $enviroment = 'test';

    /**
     * DoctrineTestCase constructor.
     *
     * @param null   $name
     * @param array  $data
     * @param string $dataName
     */
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
        $this->em        = $this->getEntityManager();
    }

    /**
     * @param Loader $loader
     */
    protected function executeFixtures( Loader $loader )
    {
        $purger   = new ORMPurger();
        $executer = new ORMExecutor( $this->em, $purger );
        $executer->execute( $loader->getFixtures() );
    }

    /**
     * @param $directory
     */
    protected function loadFixturesFromDirectory( $directory )
    {
        $loader = new Loader();
        $loader->loadFromDirectory( $directory );
        $this->executeFixtures( $loader );
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->container->get( 'doctrine.orm.entity_manager' );
    }
}
