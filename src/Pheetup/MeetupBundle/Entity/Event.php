<?php
/**
 * Created by PhpStorm.
 * User: Ahmet
 * Date: 12.03.2016
 * Time: 08:09
 */

namespace Pheetup\MeetupBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity(repositoryClass="Pheetup\MeetupBundle\Entity\EventRepository")
 * @ORM\Table
 */
class Event
{
    /**
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    /**
     * @ORM\Column(name="title",type="string", unique=true)
     */
    protected $title;
    /**
     * @ORM\Column(name="start",type="datetime")
     */
    protected $start;
    /**
     * @ORM\Column(name="finish",type="datetime")
     */
    protected $finish;
    /**
     * @ORM\Column(name="location",type="string")
     */
    protected $location;
    /**
     * @ORM\Column(name="description",type="text")
     */
    protected $description;
    /**
     * @ORM\ManyToOne(targetEntity="Pheetup\UserBundle\Entity\Group", inversedBy="events",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    protected $group;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Event
     */
    public function setTitle( $title )
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Event
     */
    public function setStart( $start )
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set finish
     *
     * @param \DateTime $finish
     *
     * @return Event
     */
    public function setFinish( $finish )
    {
        $this->finish = $finish;

        return $this;
    }

    /**
     * Get finish
     *
     * @return \DateTime
     */
    public function getFinish()
    {
        return $this->finish;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Event
     */
    public function setLocation( $location )
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
     * Set description
     *
     * @param string $description
     *
     * @return Event
     */
    public function setDescription( $description )
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
     * Set group
     *
     * @param \Pheetup\UserBundle\Entity\Group $group
     *
     * @return Event
     */
    public function setGroup(\Pheetup\UserBundle\Entity\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Pheetup\UserBundle\Entity\Group
     */
    public function getGroup()
    {
        return $this->group;
    }
}
