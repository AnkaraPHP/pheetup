<?php
/**
 * pheetup
 * User: emreyilmaz
 */

namespace Pheetup\MeetupBundle\Test\Entity\DataFixtures;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Pheetup\MeetupBundle\Entity\Event;

class LoadEventData extends AbstractFixture
{
    public function load( ObjectManager $om )
    {
        $om->clear();

        //Februus
        $start  = \DateTime::createFromFormat( "d-m-Y H:i:s", "06-02-2016 16:00:00" );
        $finish = \DateTime::createFromFormat( "d-m-Y H:i:s", "06-02-2016 19:00:00" );
        $event  = new Event();
        $event->setTitle( "AnkaraPHP Februus" )
              ->setDescription( "February event" )
              ->setLocation( "Kivilcim TTGV" )
              ->setStart( $start )
              ->setFinish( $finish )
        ;
        $this->addReference( 'event-februus', $event );
        $om->persist( $event );


        $om->flush();
    }
}