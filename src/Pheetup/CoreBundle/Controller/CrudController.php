<?php

namespace Pheetup\CoreBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Pheetup\CoreBundle\Entity\CrudRepositoryInterface;
use Pheetup\UserBundle\Entity\Group;
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
    /** @var string */
    protected $route = null;
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
        $entity = $repository->find($id);
        if (!$entity) {
            $entity = $repository->createEntity();
        }

        $form = $this->getCreateForm( $entity );
        $form->handleRequest( $request );

        if ($form->isSubmitted() && $request->getMethod() === "POST")
        {
            if ( $form->isValid() )
            {

                $em = $this->getDoctrine()->getManager();
                $em->persist( $entity );
                $em->flush();

                return RedirectResponse::create($this->getRouter());
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
        $viewData["route"] = $this->route;
        $response          = $this->render( "@PheetupCore/Crud/list.html.twig", $viewData );

        return $response;
    }

    public function deleteAction( Request $request, $id )
    {
        $em = $this->em;
        $repository = $this->getRepository();
        $event = $repository->find($id);
        if ( !$event )
        {
            throw new NotFoundHttpException;
        }
        $listPage = $this->getRouter();
        $em->remove($event);
        $em->flush();
        $session= $this->get('session');
        $session->getFlashBag()->add('notice', 'Successfully Deleted '.$this->name);

        return RedirectResponse::create( $listPage, 302 );
    }

    public function viewAction($id)
    {
        $repo = $this->getRepository();
        $view = [];
        $item = $repo->find($id);
        $view["item"] = $item;
        $view["title"] = $this->name;
        return $this->render('@PheetupCore/Crud/view.html.twig', $view);
    }

    /** @return EntityRepository */
    protected function getRepository()
    {
        return NULL;
    }

    protected function getRouter()
    {
        return null;
    }

    protected function getCreateForm( $entity )
    {
        $form = $this->createForm( new $this->formType(), $entity );

        return $form;
    }
}
