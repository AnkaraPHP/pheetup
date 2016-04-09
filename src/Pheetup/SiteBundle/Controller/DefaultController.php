<?php

namespace Pheetup\SiteBundle\Controller;

use Pheetup\MeetupBundle\Entity\Event;
use Pheetup\UserBundle\Entity\Group;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $lastEvents = $this->getDoctrine()
            ->getRepository('PheetupMeetupBundle:Event')
            ->findBy(
                [],
                ['id' => 'DESC'],
                5,
                0
            );

        return [
            'lastEvents' => $lastEvents,
        ];
    }

    /**
     * @Route("/{domain}")
     * @ParamConverter("group",class="PheetupUserBundle:Group")
     */
    public function groupAction(Group $group)
    {
        return $this->forward('pheetup.controller.user.group:viewAction', ['id' => $group->getId()]);
    }

    /**
     * @Route("/event/{id}")
     * @ParamConverter("event",class="PheetupMeetupBundle:Event")
     */
    public function registerGroupAction(Event $event, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $group = $em->getRepository('PheetupUserBundle:Group')->find($id);
        $event->setGroup($group);
        $em->persist($event);
        $em->flush();
    }

    /**
     * @Route("/{group}/events/{id}")
     */
    public function eventAction($id)
    {
        return $this->forward('pheetup.controller.meetup.event:viewAction', ['id' => $id]);
    }
}
