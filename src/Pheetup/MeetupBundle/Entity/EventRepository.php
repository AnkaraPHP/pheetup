<?php
/**
 * pheetup
 * User: emreyilmaz
 */

namespace Pheetup\MeetupBundle\Entity;


use Doctrine\ORM\EntityRepository;
use Pheetup\CoreBundle\Entity\CrudRepositoryInterface;

class EventRepository extends EntityRepository
    implements CrudRepositoryInterface
{
    public function createEntity()
    {
        $event = new Event();

        return $event;
    }
    
}