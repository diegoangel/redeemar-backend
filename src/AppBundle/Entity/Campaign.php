<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="campaign", indexes={@ORM\Index(name="idx_name", columns={"name"}), @ORM\Index(name="idx_start_date", columns={"start_date"}), @ORM\Index(name="idx_end_date", columns={"end_date"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CampaignRepository")
 */
class Campaign
{
    const OFF = 0;
    const ON = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=false)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=false)
     */
    private $endDate;
    
    /**
     * @var \AppBundle\Entity\Company
     * 
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company", inversedBy="campaigns")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_id", referencedColumnName="id")  
     * })
     */
    private $company;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Offer", mappedBy="campaign")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="campaign_id", referencedColumnName="id")
     * })
     */
    private $offers;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Location", inversedBy="campaigns")
     * @ORM\JoinTable(name="campaign_location")
     *
     */
    private $locations;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active = self::ON;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->offers = new ArrayCollection();
        $this->locations = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Campaign
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
     * Set company
     *
     * @param \AppBundle\Entity\Company $company
     *
     * @return Campaign
     */
    public function setCompany(\AppBundle\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \AppBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Add offer
     *
     * @param \AppBundle\Entity\Offer $offer
     *
     * @return Campaign
     */
    public function addOffer(\AppBundle\Entity\Offer $offer)
    {
        $this->offers[] = $offer;

        return $this;
    }

    /**
     * Remove offer
     *
     * @param \AppBundle\Entity\Offer $offer
     */
    public function removeOffer(\AppBundle\Entity\Offer $offer)
    {
        $this->offers->removeElement($offer);
    }

    /**
     * Get offers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Campaign
     */
    public function setStartDate(DateTime $startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Campaign
     */
    public function setEndDate(DateTime $endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Campaign
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Add location
     *
     * @param \AppBundle\Entity\Location $location
     *
     * @return Campaign
     */
    public function addLocation(\AppBundle\Entity\Location $location)
    {
        $this->locations[] = $location;

        return $this;
    }

    /**
     * Remove location
     *
     * @param \AppBundle\Entity\Location $location
     */
    public function removeLocation(\AppBundle\Entity\Location $location)
    {
        $this->locations->removeElement($location);
    }

    /**
     * Get locations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocations()
    {
        return $this->locations;
    }
}
