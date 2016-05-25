<?php
/**
 * pheetup
 * User: emreyilmaz
 */

namespace Pheetup\UserBundle\Tests\Entity\DataFixtures;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Pheetup\UserBundle\Entity\Group;
use Pheetup\UserBundle\Entity\Member;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadMemberData extends AbstractFixture
{
    public function load( ObjectManager $om )
    {
        $om->clear();
        $member = new Member();
        $member->setUsername( "delirehberi" )
               ->setEmail( "delirehberi@gmail.com" )
               ->setEnabled( TRUE )
               ->setExpired( FALSE )
        ;
        $member->setFirstName( "Emre" )
               ->setLastName( "YILMAZ" )
               ->setLocked( FALSE )
               ->setPassword( "null" )
               ->setSuperAdmin( TRUE )
               ->setEmailCanonical( "delirehberi@gmail.com" )
               ->setUsernameCanonical( "delirehberi" )
        ;
        $this->addReference( 'member-delirehberi', $member );
        $om->persist( $member );
        $dir = dirname(dirname(__DIR__)).'/Media/';
        copy($dir.'test.jpg', $dir.'test1.jpg');
        $logo = new UploadedFile(
            $dir.'test1.jpg',
            'test.jpg',
            'image/jpeg',
            115671,
            null,
            true
        );
        $group = new Group("AnkaraPHP");
        $group->setDomain("ankaraphp");
        $group->setDescription("Ankaradaki Php geliştiricilerinin toplandığı bir grup");
        $group->setLocation("Ankara/Turkey");
        $group->setLogo($logo);
        ;
        $this->addReference( 'group-ankaraphp', $group );

        $om->persist( $group );
        $om->flush();
    }
}