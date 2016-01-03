<?php

namespace Pheetup\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User;

/**
 * Member
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pheetup\UserBundle\Entity\MemberRepository")
 */
class Member extends User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @var string
     * @ORM\Column(name="github_id", type="string", nullable=true)
     */
    protected $github_id;

    /**
     * @var string
     * @ORM\Column(name="github_access_token", type="string", nullable=true)
     */
    protected $github_access_token;

    /**
     * @var string
     * @ORM\Column(name="first_name", type="string", nullable=true)
     */
    protected $first_name;

    /**
     * @var string
     * @ORM\Column(name="last_name", type="string", nullable=true)
     */
    protected $last_name;
    /**
     * @return string
     */
    public function getGithubId()
    {
        return $this->github_id;
    }

    /**
     * @param string $github_id
     */
    public function setGithubId($github_id)
    {
        $this->github_id = $github_id;
    }

    /**
     * @return string
     */
    public function getGithubAccessToken()
    {
        return $this->github_access_token;
    }

    /**
     * @param string $github_access_token
     */
    public function setGithubAccessToken($github_access_token)
    {
        $this->github_access_token = $github_access_token;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param $first_name
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param $last_name
     * @return $this
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
        return $this;
    }



}

