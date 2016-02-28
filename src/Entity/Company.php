<?php

namespace Redeemar\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Company
 *
 * @ORM\Table(name="company", uniqueConstraints={@ORM\UniqueConstraint(name="uidx_name", columns={"name"})}, indexes={@ORM\Index(name="fk_user_id", columns={"user_id"}), @ORM\Index(name="fk_category_id", columns={"category_id"})})
 * @ORM\Entity
 */
class Company
{
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=100, nullable=false)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="text", length=65535, nullable=false)
     */
    private $video;

    /**
     * @var \Redeemar\Entity\User
     *
     * @ORM\OneToOne(targetEntity="Redeemar\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Redeemar\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Redeemar\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="Redeemar\Entity\Logo", mappedBy="company")
     */
    private $logos;

    /**
     * @ORM\OneToMany(targetEntity="Redeemar\Entity\Campaign", mappedBy="company")
     */
    private $campaigns;



    /**
     * Constructor
     */
    public function __construct() 
    {
        $this->campaigns = new ArrayCollection();
        $this->logos = new ArrayCollection();
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
     * @return Company
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
     * Set website
     *
     * @param string $website
     * @return Company
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
     * Set description
     *
     * @param string $description
     * @return Company
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
     * Set address
     *
     * @param string $address
     * @return Company
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
     * Set video
     *
     * @param string $video
     * @return Company
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set user
     *
     * @param \Redeemar\Entity\User $user
     * @return Company
     */
    public function setUser(\Redeemar\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Redeemar\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set category
     *
     * @param \Redeemar\Entity\Category $category
     * @return Company
     */
    public function setCategory(\Redeemar\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Redeemar\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add logo
     *
     * @param \Redeemar\Entity\Logo $logo
     *
     * @return Company
     */
    public function addLogo(\Redeemar\Entity\Logo $logo)
    {
        $this->logos[] = $logo;

        return $this;
    }

    /**
     * Remove logo
     *
     * @param \Redeemar\Entity\Logo $logo
     */
    public function removeLogo(\Redeemar\Entity\Logo $logo)
    {
        $this->logos->removeElement($logo);
    }

    /**
     * Get logos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLogos()
    {
        return $this->logos;
    }

    /**
     * Add campaign
     *
     * @param \Redeemar\Entity\Campaign $campaign
     *
     * @return Company
     */
    public function addCampaign(\Redeemar\Entity\Campaign $campaign)
    {
        $this->campaigns[] = $campaign;

        return $this;
    }

    /**
     * Remove campaign
     *
     * @param \Redeemar\Entity\Campaign $campaign
     */
    public function removeCampaign(\Redeemar\Entity\Campaign $campaign)
    {
        $this->campaigns->removeElement($campaign);
    }

    /**
     * Get campaigns
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCampaigns()
    {
        return $this->campaigns;
    }
}
