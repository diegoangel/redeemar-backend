<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ValidationUserOffer
 *
 * @ORM\Table(name="validation_user_offer", indexes={@ORM\Index(name="fk_validation_user_id", columns={"validation_user_id"}), @ORM\Index(name="fk_offer_id", columns={"offer_id"})})
 * @ORM\Entity
 */
class ValidationUserOffer
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
     * @var \AppBundle\Entity\ValidatorUser
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ValidatorUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="validation_user_id", referencedColumnName="id")
     * })
     */
    private $validationUser;

    /**
     * @var \AppBundle\Entity\Offer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Offer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="offer_id", referencedColumnName="id")
     * })
     */
    private $offer;



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
     * Set validationUser
     *
     * @param \AppBundle\Entity\ValidatorUser $validationUser
     * @return ValidationUserOffer
     */
    public function setValidationUser(\AppBundle\Entity\ValidatorUser $validationUser = null)
    {
        $this->validationUser = $validationUser;

        return $this;
    }

    /**
     * Get validationUser
     *
     * @return \AppBundle\Entity\ValidatorUser 
     */
    public function getValidationUser()
    {
        return $this->validationUser;
    }

    /**
     * Set offer
     *
     * @param \AppBundle\Entity\Offer $offer
     * @return ValidationUserOffer
     */
    public function setOffer(\AppBundle\Entity\Offer $offer = null)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return \AppBundle\Entity\Offer 
     */
    public function getOffer()
    {
        return $this->offer;
    }
}
