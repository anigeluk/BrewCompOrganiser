<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use DateTime;

/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LocationRepository")
 * @Vich\Uploadable
 */
class Location
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=255)
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var file
     *
     * @Vich\UploadableField(mapping="imageFile", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dropoff", type="boolean", nullable=false)
     */
    private $dropoff;

    /**
     * @var boolean
     *
     * @ORM\Column(name="shipping", type="boolean", nullable=false)
     */
    private $shipping;

    /**
     * @var boolean
     *
     * @ORM\Column(name="judging", type="boolean", nullable=false)
     */
    private $judging;

    /**
     * @var boolean
     *
     * @ORM\Column(name="awards", type="boolean", nullable=false)
     */
    private $awards;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sponsor", type="boolean", nullable=false)
     */
    private $sponsor;

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
     * @return Location
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
     * Set address
     *
     * @param string $address
     *
     * @return Location
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     *
     * @return Location
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return Location
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Location
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }


    /**
     * Set image
     *
     * @param string $image
     *
     * @return Location
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set if this location is used for dropoff
     *
     * @param boolean $image
     *
     * @return Location
     */
    public function setDropoff($val)
    {
        $this->dropoff = $val;

        return $this;
    }

    /**
     * Get if this location is used for dropoff
     *
     * @return boolean
     */
    public function getDropoff()
    {
        return $this->dropoff;
    }

    /**
     * Set if this location is used for shipping
     *
     * @param boolean $image
     *
     * @return Location
     */
    public function setShipping($val)
    {
        $this->shipping = $val;

        return $this;
    }

    /**
     * Get if this location is used for shipping
     *
     * @return boolean
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * Set if this location is used for judging
     *
     * @param boolean $image
     *
     * @return Location
     */
    public function setJudging($val)
    {
        $this->judging = $val;

        return $this;
    }

    /**
     * Get if this location is used for judging
     *
     * @return boolean
     */
    public function getJudging()
    {
        return $this->judging;
    }

    /**
     * Set if this location is used for awards
     *
     * @param boolean $image
     *
     * @return Location
     */
    public function setAwards($val)
    {
        $this->awards = $val;

        return $this;
    }

    /**
     * Get if this location is used for awards
     *
     * @return boolean
     */
    public function getAwards()
    {
        return $this->awards;
    }

    /**
     * Set if this location is used for sponsors
     *
     * @param boolean $image
     *
     * @return Location
     */
    public function setSponsors($val)
    {
        $this->sponsors = $val;

        return $this;
    }

    /**
     * Get if this location is used for sponsors
     *
     * @return boolean
     */
    public function getSponsors()
    {
        return $this->sponsors;
    }

    /**
     * Set sponsor
     *
     * @param boolean $sponsor
     *
     * @return Location
     */
    public function setSponsor($sponsor)
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    /**
     * Get sponsor
     *
     * @return boolean
     */
    public function getSponsor()
    {
        return $this->sponsor;
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
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

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
    public function getImageFile()
    {
        return $this->imageFile;
    }
}
