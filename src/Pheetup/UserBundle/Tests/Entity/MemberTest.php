<?php
/**
 * pheetup
 * User: emreyilmaz
 */

namespace Pheetup\UserBundle\Tests\Entity;


use Pheetup\CoreBundle\Tests\Repository\DoctrineTestCase;

class MemberTest extends DoctrineTestCase
{
    const TEST_USERNAME = "delirehberi";

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        $this->loadFixturesFromDirectory( __DIR__ . '/DataFixtures' );
    }

    /**
     * dummy test.
     */
    public function testGetMember()
    {
        $repo   = $this->getRepository();
        $member = $repo->findOneBy( [ 'username' => self::TEST_USERNAME ] );

        $this->assertEquals( self::TEST_USERNAME, $member->getUsername() );
    }

    public function getRepository()
    {
        return $this->em->getRepository( "PheetupUserBundle:Member" );
    }
}