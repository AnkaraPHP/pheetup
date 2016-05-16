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
    /**
     * @todo GroupController Test
     * Çok uğraştım ama form'u işlerken dosyayı görmedi bir türlü
     * Bu testi daha sonra yazarım diye düşündüm
     */
    /**
     * private function createGroup($name, $domain)
     * {
     * $this->assertTrue(file_exists(dirname($this->container->getParameter('kernel.root_dir')).'/src/Pheetup/UserBundle/Tests/Media/test.jpg'));
     * $client = static::createClient();
     * $csrf = $client->getContainer()->get('security.csrf.token_manager');
     * $token = $csrf->getToken('pheetup_userbundle_group');
     * $file = array(
     * 'tmp_name' => dirname($this->container->getParameter('kernel.root_dir')).'/src/Pheetup/UserBundle/Tests/Media/test.jpg',
     * 'name' => 'photo.jpg',
     * 'type' => 'image/jpeg',
     * 'size' => 115671,
     * 'error' => UPLOAD_ERR_OK);
     * $client->followRedirects(true);
     * $crawler = $client->request(
     * 'POST',
     * '/group/create',
     * ['pheetup_userbundle_group' =>
     * [
     * 'name' => $name,
     * 'description' => "Ankara'da güzel bir grup",
     * 'location' => 'Ankara / Turkey',
     * 'domain' => $domain,
     * 'submit' => '',
     * '_token' => $token,
     * ]
     * ],
     * [
     * 'pheetup_userbundle_group[logo]'=>$file
     * ]
     * );
     * file_put_contents('a.html',$crawler->html());
     * }
     **/

    public function testCreateAction()
    {
        /*
        $name = 'AnkaraPhp';
        $domain = 'ankaraphp';
        $this->createGroup($name, $domain);
        $groupRepository = $this->em->getRepository('PheetupUserBundle:Group');
        var_dump($groupRepository->findAll());
        $group = $groupRepository->findOneBy(['name' => $name]);
        $this->assertNotEmpty($group->getDescription());
         **/
    }
}
