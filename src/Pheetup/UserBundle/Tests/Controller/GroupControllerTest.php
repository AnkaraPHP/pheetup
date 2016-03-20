<?php
/**
 * Created by PhpStorm.
 * User: Ahmet
 * Date: 19.03.2016
 * Time: 15:31
 */

namespace FOS\UserBundle\Tests\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Pheetup\CoreBundle\Tests\Controller\ControllerTestCase;

class GroupControllerTest extends ControllerTestCase
{
    /** @var  EntityManager */
    private $em;

    protected function setUp()
    {
        $this->setController('user.group');
        $this->em = $this->container->get('doctrine.orm.entity_manager');
    }

    public function testCreateAction()
    {
        $request = new Request();
        $request->setMethod('POST');
        $csrf = $this->container->get('security.csrf.token_manager');
        $token = $csrf->getToken('pheetup_userbundle_group');
        $request->request->set(
            'pheetup_userbundle_group',
            [
                'name' => "AnkaraPhp",
                'description' => "Ankara'da güzel bir grup",
                'logo' => "img.png",
                'location' => 'Ankara / Turkey',
                'domain' => 'ankaraphp',
                'submit' => 'submit',
                '_token' => $token,
            ]
        );
        $response = $this->controller->createAction($request);
        $this->assertEquals(200, $response->getStatusCode());

        $groupRepository = $this->em->getRepository('PheetupUserBundle:Group');

        $group = $groupRepository->findOneBy(['name' => 'AnkaraPhp']);
        $this->assertNotEmpty($group->getId());
    }
}