<?php
/**
 * Created by PhpStorm.
 * User: Ahmet
 * Date: 19.03.2016
 * Time: 15:31
 */

namespace Pheetup\SiteBundle\Tests\Controller;

use Doctrine\ORM\EntityManager;
use Pheetup\SiteBundle\Controller\DefaultController;
use Symfony\Component\HttpFoundation\Request;
use Pheetup\CoreBundle\Tests\Controller\ControllerTestCase;

class DefaultControllerTest extends ControllerTestCase
{
    /** @var  EntityManager */
    private $em;

    protected function setUp()
    {
        $this->setController('site.default');
        $this->em = $this->container->get('doctrine.orm.entity_manager');
    }

    /**
     * @todo DefaultControllerTest
     * Grup testini yazamadığım için burayıda sonra halledeceğim
     *
    * private function createGroup($controller, $name, $domain)
    * {
        * $request = new Request();
        * $request->setMethod('POST');
        * $csrf = $this->container->get('security.csrf.token_manager');
        * $token = $csrf->getToken('pheetup_userbundle_group');
        * $request->request->set(
            * 'pheetup_userbundle_group',
            * [
                * 'name' => $name,
                * 'description' => "Ankara'da güzel bir grup",
                * 'logo' => "img.png",
                * 'location' => 'Ankara / Turkey',
                * 'domain' => $domain,
                * 'submit' => 'submit',
                * '_token' => $token,
            * ]
        * );
 *
* return $controller->createAction($request);
    * }
 *
* public function testJoinAction()
    * {
        * $name = "GrupDeneme";
        * $domain = "denemegrup";
        * $groupResponse = $this->createGroup($this->container->get('pheetup.controller.user.group'), $name, $domain);
        * $request = new Request();
        * $request->setMethod('GET');
        * $groupRepository = $this->em->getRepository('PheetupUserBundle:Group');
        * $group = $groupRepository->findOneBy(['name' => $name]);
        * $this->assertNotEmpty($group->getId());;
        * $userManager = $this->container->get('fos_user.user_manager');
        * $user = $userManager->createUser();
        * $user->setUsername('ahmet');
        * $user->setEmail('ahmetersin06@gmail.com');
        * $user->setPlainPassword('deneme');
        * $user->setEnabled(true);
        * $userManager->updateUser($user);
        * $user = $userManager->findUserBy(array('username' => 'ahmet'));
        * $loginManager = $this->container->get('fos_user.security.login_manager');
        * $firewallName = $this->container->getParameter('fos_user.firewall_name');
        * $loginManager->logInUser($firewallName, $user);
        * $this->assertTrue($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'));
        * $controller = new DefaultController();
        * $controller->setContainer($this->container);
        * $response = $controller->joinAction($group);
        * $this->assertEquals($response->getContent(), "You successfully joined group");
     *
     * }
     **/
}
