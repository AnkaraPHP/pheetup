<?php

namespace Pheetup\MeetupBundle\Controller;

use Pheetup\MeetupBundle\Entity\Event;
use Pheetup\MeetupBundle\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
    /**
     * @Route("new-event")
     */
    public function newEventAction(Request $request){
        $event = new Event();
        $form = $this->createForm(new EventType(),$event);
        $form->handleRequest($request);
        if($form->isSubmitted() && $request->getMethod()=="POST"){
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return Response::create("Etkinlik Oluşturuldu");
        }
        else{
            return $this->render("@PheetupMeetup/Default/newEvent.html.twig",[
                "form"=>$form->createView()
            ]);
        }
    }

    /**
     * @Route("list-event")
     */
    public function listEventAction(){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("PheetupMeetupBundle:Event");
        $items = $repo->findAll();
        return $this->render("@PheetupMeetup/Default/listEvent.html.twig",[
            "eventArr"=>$items
        ]);
    }

    /**
     * @Route("view/{id}")
     */
    public function viewEventAction($id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("PheetupMeetupBundle:Event");
        $item = $repo->find($id);
        if(!$item){
            throw $this->createNotFoundException("Bu id'ye sahip bir etkinlik bulunamadı. İd : {$id}");
        }
        return $this->render("@PheetupMeetup/Default/viewEvent.html.twig",[
            "event"=>$item
        ]);
    }
    /**
     * @Route("update/{id}")
     */
    public function updateEventAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("PheetupMeetupBundle:Event")->find($id);
        $form = $this->createForm(new EventType(),$event);
        $form->handleRequest($request);
        if (!$event) {
            throw $this->createNotFoundException("Bu id'ye sahip bir etkinlik bulunamadı. İd : {$id}");
        }
        if($request->getMethod() == "POST") {
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('pheetup_meetup_default_viewevent',["id"=>$id]);
        }
        else{
            return $this->render("@PheetupMeetup/Default/newEvent.html.twig",[
                "form"=>$form->createView()
            ]);
        }
    }

    /**
     * @Route("delete/{id}")
     */
    public function deleteEventAction($id){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("PheetupMeetupBundle:Event")->find($id);
        $em->remove($event);
        $em->flush();
        return Response::create("{$id} Numaralı Etkinlik Silindi");
    }
}
