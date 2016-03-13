<?php

namespace Pheetup\MeetupBundle\Tests\Entity;

use Pheetup\CoreBundle\Tests\Repository\DoctrineTestCase;
use Pheetup\MeetupBundle\Entity\Event;


class EventTest extends DoctrineTestCase
{

    protected function setUp()
    {
        $this->loadFixturesFromDirectory( __DIR__ . '/DataFixtures' );
    }

    public function testGetEvent()
    {
        $eventRepo = $this->getRepository();
        $events    = $eventRepo->findAll();
        $this->assertCount( 1, $events );
        $this->assertEquals( 'Kivilcim TTGV', $events[0]->getLocation() );
    }

    protected function getRepository()
    {
        return $this->em->getRepository( 'PheetupMeetupBundle:Event' );
    }
}
