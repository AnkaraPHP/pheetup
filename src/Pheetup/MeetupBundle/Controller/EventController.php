<?php

namespace Pheetup\MeetupBundle\Controller;

use Pheetup\CoreBundle\Controller\CrudController as Controller;
use Pheetup\MeetupBundle\Entity\Event;

/**
 * Class EventController
 *
 * @package Pheetup\MeetupBundle\Controller
 *
 */
class EventController extends Controller
{
    protected $formType = 'Pheetup\MeetupBundle\Form\EventType';

    protected function getRepository()
    {
        return $this->em->getRepository( "PheetupMeetupBundle:Event" );
    }
}
