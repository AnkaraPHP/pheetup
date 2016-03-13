<?php
namespace Pheetup\MeetupBundle\Tests\Entity;

use Pheetup\MeetupBundle\Entity\Event;

/**
 * User: emreyilmaz
 * Date: 13.03.2016
 * Time: 13:42
 */
class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testNewEvent()
    {
        $event = new Event();
        $event->setDescription("Description")
            ->setLocation("Ankara, Turkey")
            ->setStart(new \DateTime("+4 days"))
            ->setFinish(new \DateTime("+5 days"))
            ->setTitle("AnkaraPHP Februus");
        $this->assertTrue($event->getTitle() == "AnkaraPHP Februus");
    }
}
