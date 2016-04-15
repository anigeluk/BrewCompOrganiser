<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Competition
 *
 * @ORM\Table(name="competition")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompetitionRepository")
 * @Vich\Uploadable
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
     * @var file
     *
     * @Vich\UploadableField(mapping="logo_file", fileNameProperty="logoFilename")
     */
    private $logoFile;

    /**
     * @var string
     *
     * @ORM\Column(name="logoFilename", type="string", length=255)
     */
    private $logoFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="bjcpCompetitionId", type="string", length=255, nullable=true)
     */
    private $bjcpCompetitionId;

    /**
     * @var string
     *
     * @ORM\Column(name="hostName", type="string", length=255, nullable=true)
     */
    private $hostName;

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
     * @var \DateTime
     * @Assert\DateTime()
     * 
     * @ORM\Column(name="registrationOpen", type="datetime", nullable=true)
     */
    private $registrationOpen;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     * @Assert\Expression(
     *     "this.getRegistrationClose() == '' || this.getRegistrationOpen() < this.getRegistrationClose()",
     *     message="Close time must be after open time!"
     * )
     *
     * @ORM\Column(name="registrationClose", type="datetime", nullable=true)
     */
    private $registrationClose;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     *
     * @ORM\Column(name="entryOpen", type="datetime", nullable=true)
     */
    private $entryOpen;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     * @Assert\Expression(
     *     "this.getEntryClose() == '' || this.getEntryOpen() <= this.getEntryClose()",
     *     message="Close time must be after open time!"
     * )
     *
     * @ORM\Column(name="entryClose", type="datetime", nullable=true)
     */
    private $entryClose;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     *
     * @ORM\Column(name="dropOffOpen", type="datetime", nullable=true)
     */
    private $dropOffOpen;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     * @Assert\Expression(
     *     "this.getDropOffClose() == '' || this.getDropOffOpen() <= this.getDropOffClose()",
     *     message="Close time must be after open time!"
     * )
     *
     * @ORM\Column(name="dropOffClose", type="datetime", nullable=true)
     */
    private $dropOffClose;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     *
     * @ORM\Column(name="shippingOpen", type="datetime", nullable=true)
     */
    private $shippingOpen;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     * @Assert\Expression(
     *     "this.getShippingClose() == '' || this.getShippingOpen() <= this.getShippingClose()",
     *     message="Close time must be after open time!"
     * )
     *
     * @ORM\Column(name="shippingClose", type="datetime", nullable=true)
     */
    private $shippingClose;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     *
     * @ORM\Column(name="lockDown", type="datetime", nullable=true)
     */
    private $lockDown;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;

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
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setLogoFile(File $image = null)
    {
        $this->logoFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getLogoFile()
    {
        return $this->logoFile;
    }

    /**
     * Set logoFilename
     *
     * @param string $logoFilename
     *
     * @return Competition
     */
    public function setLogoFilename($logoFilename)
    {
        $this->logoFilename = $logoFilename;

        return $this;
    }

    /**
     * Get logoFilename
     *
     * @return string
     */
    public function getLogoFilename()
    {
        return $this->logoFilename;
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
     * Set hostName
     *
     * @param string $hostName
     *
     * @return Competition
     */
    public function setHostName($hostName)
    {
        $this->hostName = $hostName;

        return $this;
    }

    /**
     * Get hostName
     *
     * @return string
     */
    public function getHostName()
    {
        return $this->hostName;
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

    /**
     * Set registrationOpen
     *
     * @param \DateTime $registrationOpen
     *
     * @return Competition
     */
    public function setRegistrationOpen($registrationOpen)
    {
        $this->registrationOpen = $registrationOpen;

        return $this;
    }

    /**
     * Get registrationOpen
     *
     * @return \DateTime
     */
    public function getRegistrationOpen()
    {
        return $this->registrationOpen;
    }

    /**
     * Set registrationClose
     *
     * @param \DateTime $registrationClose
     *
     * @return Competition
     */
    public function setRegistrationClose($registrationClose)
    {
        $this->registrationClose = $registrationClose;

        return $this;
    }

    /**
     * Get registrationClose
     *
     * @return \DateTime
     */
    public function getRegistrationClose()
    {
        return $this->registrationClose;
    }

    /**
     * Set entryOpen
     *
     * @param \DateTime $entryOpen
     *
     * @return Competition
     */
    public function setEntryOpen($entryOpen)
    {
        $this->entryOpen = $entryOpen;

        return $this;
    }

    /**
     * Get entryOpen
     *
     * @return \DateTime
     */
    public function getEntryOpen()
    {
        return $this->entryOpen;
    }

    /**
     * Set entryClose
     *
     * @param \DateTime $entryClose
     *
     * @return Competition
     */
    public function setEntryClose($entryClose)
    {
        $this->entryClose = $entryClose;

        return $this;
    }

    /**
     * Get entryClose
     *
     * @return \DateTime
     */
    public function getEntryClose()
    {
        return $this->entryClose;
    }

    /**
     * Set dropOffOpen
     *
     * @param \DateTime $dropOffOpen
     *
     * @return Competition
     */
    public function setDropOffOpen($dropOffOpen)
    {
        $this->dropOffOpen = $dropOffOpen;

        return $this;
    }

    /**
     * Get dropOffOpen
     *
     * @return \DateTime
     */
    public function getDropOffOpen()
    {
        return $this->dropOffOpen;
    }

    /**
     * Set dropOffClose
     *
     * @param \DateTime $dropOffClose
     *
     * @return Competition
     */
    public function setDropOffClose($dropOffClose)
    {
        $this->dropOffClose = $dropOffClose;

        return $this;
    }

    /**
     * Get dropOffClose
     *
     * @return \DateTime
     */
    public function getDropOffClose()
    {
        return $this->dropOffClose;
    }

    /**
     * Set shippingOpen
     *
     * @param \DateTime $shippingOpen
     *
     * @return Competition
     */
    public function setShippingOpen($shippingOpen)
    {
        $this->shippingOpen = $shippingOpen;

        return $this;
    }

    /**
     * Get shippingOpen
     *
     * @return \DateTime
     */
    public function getShippingOpen()
    {
        return $this->shippingOpen;
    }

    /**
     * Set shippingClose
     *
     * @param \DateTime $shippingClose
     *
     * @return Competition
     */
    public function setShippingClose($shippingClose)
    {
        $this->shippingClose = $shippingClose;

        return $this;
    }

    /**
     * Get shippingClose
     *
     * @return \DateTime
     */
    public function getShippingClose()
    {
        return $this->shippingClose;
    }

    /**
     * Set lockDown
     *
     * @param \DateTime $lockDown
     *
     * @return Competition
     */
    public function setLockDown($lockDown)
    {
        $this->lockDown = $lockDown;

        return $this;
    }

    /**
     * Get lockDown
     *
     * @return \DateTime
     */
    public function getLockDown()
    {
        return $this->lockDown;
    }
}

