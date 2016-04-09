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
 * @ORM\Entity(repositoryClass="Pheetup\UserBundle\Entity\GroupRepository")
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
     * @var string
     * @ORM\Column(type="string")
     */
    protected $description;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $location;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $logo;
    /**
     * @ORM\OneToMany(targetEntity="Pheetup\MeetupBundle\Entity\Event", mappedBy="group")
     */
    protected $events;

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

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Group
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Group
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Group
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Add event
     *
     * @param \Pheetup\MeetupBundle\Entity\Event $event
     *
     * @return Group
     */
    public function addEvent(\Pheetup\MeetupBundle\Entity\Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \Pheetup\MeetupBundle\Entity\Event $event
     */
    public function removeEvent(\Pheetup\MeetupBundle\Entity\Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }
}
