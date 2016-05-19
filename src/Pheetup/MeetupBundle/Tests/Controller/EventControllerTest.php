<?php
/**
 * pheetup
 * User: emreyilmaz
 */

namespace Pheetup\MeetupBundle\Tests\Controller;


use Doctrine\ORM\EntityManager;
use Pheetup\CoreBundle\Tests\Controller\ControllerTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EventControllerTest extends ControllerTestCase
{
    /** @var  EntityManager */
    private $em;

    protected function setUp()
    {
        $this->setController( 'meetup.event' );
        $this->em = $this->container->get( 'doctrine.orm.entity_manager' );
    }

    public function testCreateEvent()
    {
        $request = new Request();
        $request->setMethod( 'POST' );
        $startDate = "2016-05-20";
        $startTime = "12:00";
        $finishDate = "2016-05-21";
        $finishTime = "10:00";
        $csrf       = $this->container->get( 'security.csrf.token_manager' );
        $token      = $csrf->getToken( 'pheetup_meetupbundle_event' );
        $request->request->set( 'pheetup_meetupbundle_event', [
            'title'       => "AnkaraPHP",
            'description' => 'Deneme',
            'start'       => [
                'date' => $startDate,
                'time' => $startTime,
            ],
            'finish'      => [
                'date' => $finishDate,
                'time' => $finishTime,
            ],
            'submit'      => 'submit',
            'location'    => "Ankara, Turkiye",
            '_token'      => $token,
        ] );
        /** @var Response $response */
        $response = $this->controller->createAction( $request );

        $this->assertEquals( 302, $response->getStatusCode() );

        $eventRepository = $this->em->getRepository( 'PheetupMeetupBundle:Event' );

        $event = $eventRepository->findOneBy( [ 'title' => "AnkaraPHP" ] );

        $this->assertNotNull( $event->getId() );

    }

    public function testListAction()
    {
        $request = new Request();
        /** @var Response $response */
        $response = $this->controller->listAction( $request );
        $this->assertRegExp( '~Event~', $response->getContent() );
    }

    public function testViewAction()
    {
        $response = $this->controller->viewAction(1);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertRegExp('~id~', $response->getContent());
    }

    public function testDeleteAction()
    {
        $request = new Request();
        $eventRepo = $this->em->getRepository( 'PheetupMeetupBundle:Event' );

        $event = $eventRepo->findOneBy( [ 'title' => "AnkaraPHP" ] );

        $response = $this->controller->deleteAction( $request, $event->getId() );
        $this->assertEquals( '302', $response->getStatusCode() );
    }

}