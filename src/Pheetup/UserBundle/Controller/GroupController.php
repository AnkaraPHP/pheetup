<?php

namespace Pheetup\UserBundle\Controller;

use Pheetup\CoreBundle\Controller\CrudController AS Controller;
use Pheetup\UserBundle\Entity\Group;

class GroupController extends Controller
{
    protected $formType = 'Pheetup\UserBundle\Form\GroupType';
    protected $name = 'Group';

    protected function getRepository()
    {
        return $this->em->getRepository("PheetupUserBundle:Group");
    }

}
