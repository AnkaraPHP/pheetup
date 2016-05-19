<?php
/**
 * Created by PhpStorm.
 * User: Ahmet
 * Date: 19.03.2016
 * Time: 15:31
 */

namespace FOS\UserBundle\Tests\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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

    private function createGroup($controller, $name, $domain)
    {
        $request = new Request();
        $request->setMethod('POST');
        $csrf = $this->container->get('security.csrf.token_manager');
        $token = $csrf->getToken('pheetup_userbundle_group');
        $dir = dirname($this->container->getParameter('kernel.root_dir')).'/src/Pheetup/UserBundle/Tests/Media/';
        copy($dir.'test.jpg', $dir.'test1.jpg');
        $path = $dir.'test1.jpg';
        $logo = new UploadedFile($path, 'test.png', 'image/png', filesize($path), UPLOAD_ERR_OK, true);
        $request->request->set(
            'pheetup_userbundle_group',
            [
                'name' => $name,
                'description' => "Ankara'da güzel bir grup",
                'logo' => $logo,
                'location' => 'Ankara / Turkey',
                'domain' => $domain,
                'submit' => 'submit',
                '_token' => $token,
            ]
        );
        $request->files->get('logo');

        return $controller->createAction($request);
    }

    public function testCreateAction()
    {
        $name = 'AnkaraPhp';
        $domain = 'ankaraphp';
        $response = $this->createGroup($this->controller, $name, $domain);
        $this->assertEquals(302, $response->getStatusCode());

        $groupRepository = $this->em->getRepository('PheetupUserBundle:Group');
        $group = $groupRepository->findOneBy(['name' => $name]);
        $this->assertNotEmpty($group->getId());
    }
}
