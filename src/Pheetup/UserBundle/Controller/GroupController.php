<?php

namespace Pheetup\UserBundle\Controller;

use Pheetup\CoreBundle\Controller\GrupCrudController AS Controller;
use Pheetup\UserBundle\Entity\Group;

class GroupController extends Controller
{
    protected $formType = 'Pheetup\UserBundle\Form\GroupType';
    protected $name = 'Event';

    protected function getRepository()
    {
        return $this->em->getRepository("PheetupUserBundle:Group");
    }

    protected function getEntity()
    {
        return new Group('');
    }
}
