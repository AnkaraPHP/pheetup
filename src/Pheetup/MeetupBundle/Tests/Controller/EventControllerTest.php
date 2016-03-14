<?php
/**
 * pheetup
 * User: emreyilmaz
 */

namespace Pheetup\MeetupBundle\Tests\Controller;


use Pheetup\CoreBundle\Tests\Controller\ControllerTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EventControllerTest extends ControllerTestCase
{
    protected function setUp()
    {
        $this->setController( 'meetup.event' );
    }

    public function testCreateEvent()
    {
        /*
         * 1- Request
         * 2- title, description,start, finish,location,submit -> event[]
         * 3- Request->Post
         */
        $request = new Request();
        $request->setMethod( 'POST' );
        $request->query->add( [
                                  'event' => [
                                      'title'       => 'AnkaraPHP Uzak Diyarlar',
                                      'description' => 'Deneme',
                                      'start'       => ( new \DateTime( "-3 days" ) )->format( "d-m-Y H:i:s" ),
                                      'finish'      => ( new \DateTime( "-2 days" ) )->format( "d-m-Y H:i:s" ),
                                      'submit'      => 'submit',
                                      'location'    => 'Ankara, Turkiye',
                                  ],
                              ] );
        /** @var Response $response */
        $response = $this->controller->createAction( $request );

        $this->assertEquals( 200, $response->getStatusCode() );
    }
}
