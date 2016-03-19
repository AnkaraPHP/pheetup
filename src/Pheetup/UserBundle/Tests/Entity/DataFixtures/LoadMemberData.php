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

        $group = new Group("AnkaraPHP");
        $group->setDomain("ankaraphp");
        $group->setDescription("Ankara php nisan ayı etkinliği");
        $group->setLocation("Bilkent Cyberpark");
        $group->setLogo("img.png");
        ;
        $this->addReference( 'group-ankaraphp', $group );

        $om->persist( $group );
        $om->flush();
    }
}