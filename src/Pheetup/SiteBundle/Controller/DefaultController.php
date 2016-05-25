<?php

namespace Pheetup\SiteBundle\Controller;

use Pheetup\MeetupBundle\Entity\Event;
use Pheetup\UserBundle\Entity\Group;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

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
        $events = $group->getEvents();

        return $this->render(
            '@PheetupSite/Default/group.html.twig',
            [
                'events' => $events,
            ]
        );
    }

    /**
     * @Route("/{domain}/join")
     * @ParamConverter("group",class="PheetupUserBundle:Group")
     */
    public function joinAction(Group $group)
    {
        $isLogin = $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY');
        if ($isLogin) {
            $token = $this->get('security.token_storage')->getToken();
            $user = $token->getUser();
            $user->addGroup($group);
        }

        return Response::create('You successfully joined group');
    }

    /**
     * @Route("/{group}/events/{id}")
     */
    public function eventAction($id)
    {
        return $this->forward('pheetup.controller.meetup.event:viewAction', ['id' => $id]);
    }
}
