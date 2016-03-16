<?php
/**
 * pheetup
 * User: emreyilmaz
 */

namespace Pheetup\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Group
 *
 * @package Pheetup\UserBundle\Entity
 * @ORM\Entity()
 * @ORM\Table(name="meetup_group")
 */
class Group extends \FOS\UserBundle\Model\Group
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(name="domain", type="string", length=255, nullable=false)
     */
    protected $domain;

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return Group
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }
}
