<?php

namespace Pheetup\CoreBundle\Controller;


use Pheetup\CoreBundle\Controller\CrudController AS Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GrupCrudController extends Controller
{
    public function createAction(Request $request, $id = 0)
    {
        $repository = $this->getRepository();
        $entity = $this->getEntity();
        $form = $this->getCreateForm($entity);
        $form->handleRequest($request);
        $viewData = [];
        $viewData["form"] = $form->createView();
        if ($form->isSubmitted() && $request->getMethod() == "POST") {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                $router = $this->container->get('router');

                return Response::create('Naber ? ');
            } else {
                return Response::create($form->getErrorsAsString(), 406);
            }
        }

        return $this->render('@PheetupCore/Crud/create.html.twig', $viewData);
    }

    protected function getEntity()
    {
        return null;
    }

}
