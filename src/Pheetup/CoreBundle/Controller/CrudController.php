<?php

namespace Pheetup\CoreBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Pheetup\CoreBundle\Entity\CrudRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CrudController extends Controller
{
    /** @var  string */
    protected $formType;

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


        $form->handleRequest($request);

        if($form->isSubmitted() && $request->getMethod()=="POST"){
           /* $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return Response::create("Etkinlik Oluşturuldu");*/
        }

        $viewData['form'] = $form->createView();

        $response = $this->render( $this->createView, $viewData );

        return $response;
    }

    public function listAction()
    {
        return new Response();
    }

    public function deleteAction()
    {
        return new Response();
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
