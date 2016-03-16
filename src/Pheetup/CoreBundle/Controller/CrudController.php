<?php

namespace Pheetup\CoreBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Pheetup\CoreBundle\Entity\CrudRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CrudController extends Controller
{
    /** @var  string */
    protected $formType;

    /** @var  string required for page headers */
    protected $name;
    /** @var EntityManager */
    protected $em;

    /** @var string */
    protected $createView = 'PheetupCoreBundle:Crud:create.html.twig';

    public function __construct( ContainerInterface $container )
    {
        $this->setContainer( $container );
        $this->em = $this->container->get( 'doctrine.orm.entity_manager' );
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     * @throws \Exception
     */
    public function createAction( Request $request, $id = 0 )
    {
        $repository = $this->getRepository();
        if ( !( $repository instanceof CrudRepositoryInterface ) )
        {
            throw new \Exception( "Repository class must be implemented CrudRepositoryInterface" );
        }
        $viewData = [ ];

        $entity = $repository->createEntity();

        $form = $this->getCreateForm( $entity );


        $form->handleRequest( $request );

        if ( $form->isSubmitted() && $request->getMethod() == "POST" )
        {
            if ( $form->isValid() )
            {

                $em = $this->getDoctrine()->getManager();
                $em->persist( $entity );
                $em->flush();
                $router = $this->container->get( 'router' );

                return RedirectResponse::create( $router->generate( 'pheetup_event' ) );
            }
            else
            {
                return Response::create( $form->getErrorsAsString(), 406 );
            }
        }
        $viewData['form'] = $form->createView();

        $response = $this->render( $this->createView, $viewData );

        return $response;
    }

    public function listAction( Request $request )
    {
        //@todo pagination
        $repo              = $this->getRepository();
        $items             = $repo->findAll();
        $viewData          = [ ];
        $viewData['items'] = $items;
        $viewData['title'] = $this->name;
        $response          = $this->render( "@PheetupCore/Crud/list.html.twig", $viewData );

        return $response;
    }

    public function deleteAction( Request $request, $id )
    {
        $event = $this->em->find( 'PheetupMeetupBundle:Event', $id );
        if ( !$event )
        {
            throw new NotFoundHttpException;
        }
        $router   = $this->get( 'router' );
        $listPage = $router->generate( 'pheetup_event' );

        //@todo add delete message to flashbag.
        return RedirectResponse::create( $listPage, 302 );
    }

    public function viewAction()
    {
        return new Response();
    }

    /** @return EntityRepository */
    protected function getRepository()
    {
        return NULL;
    }

    protected function getCreateForm( $entity )
    {
        $form = $this->createForm( new $this->formType(), $entity );

        return $form;
    }
}
