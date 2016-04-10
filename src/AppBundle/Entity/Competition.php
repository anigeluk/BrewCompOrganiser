<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competition
 *
 * @ORM\Table(name="competition")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompetitionRepository")
 */
class Competition
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="bjcpCompetitionId", type="string", length=255, nullable=true)
     */
    private $bjcpCompetitionId;

    /**
     * @var string
     *
     * @ORM\Column(name="host", type="string", length=255)
     */
    private $host;

    /**
     * @var string
     *
     * @ORM\Column(name="hostLocation", type="string", length=255, nullable=true)
     */
    private $hostLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="hostUrl", type="string", length=255, nullable=true)
     */
    private $hostUrl;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Competition
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Competition
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
     * Set logo
     *
     * @param string $logo
     *
     * @return Competition
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
     * Set bjcpCompetitionId
     *
     * @param string $bjcpCompetitionId
     *
     * @return Competition
     */
    public function setBjcpCompetitionId($bjcpCompetitionId)
    {
        $this->bjcpCompetitionId = $bjcpCompetitionId;

        return $this;
    }

    /**
     * Get bjcpCompetitionId
     *
     * @return string
     */
    public function getBjcpCompetitionId()
    {
        return $this->bjcpCompetitionId;
    }

    /**
     * Set host
     *
     * @param string $host
     *
     * @return Competition
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set hostLocation
     *
     * @param string $hostLocation
     *
     * @return Competition
     */
    public function setHostLocation($hostLocation)
    {
        $this->hostLocation = $hostLocation;

        return $this;
    }

    /**
     * Get hostLocation
     *
     * @return string
     */
    public function getHostLocation()
    {
        return $this->hostLocation;
    }

    /**
     * Set hostUrl
     *
     * @param string $hostUrl
     *
     * @return Competition
     */
    public function setHostUrl($hostUrl)
    {
        $this->hostUrl = $hostUrl;

        return $this;
    }

    /**
     * Get hostUrl
     *
     * @return string
     */
    public function getHostUrl()
    {
        return $this->hostUrl;
    }
}

