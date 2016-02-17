<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Table(name="offer", indexes={@ORM\Index(name="fk_campaign_id", columns={"campaign_id"}), @ORM\Index(name="idx_start_date", columns={"start_date"}), @ORM\Index(name="idx_end_date", columns={"end_date"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\OfferRepository")
 */
class Offer
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
     * @var string
     *
     * @ORM\Column(name="image_path", type="string", length=255, nullable=false)
     */
    private $imagePath;

    /**
     * @var boolean
     *
     * @ORM\Column(name="prepay", type="boolean", nullable=false)
     */
    private $prepay;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pay_on_validate", type="boolean", nullable=false)
     */
    private $payOnValidate;

    /**
     * @var string
     *
     * @ORM\Column(name="fixed_amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $fixedAmount;

    /**
     * @var integer
     *
     * @ORM\Column(name="percentage", type="smallint", nullable=false)
     */
    private $percentage;

    /**
     * @var integer
     *
     * @ORM\Column(name="redeemars_for_validation", type="integer", nullable=false)
     */
    private $redeemarsForValidation;

    /**
     * @var string
     *
     * @ORM\Column(name="redeemar_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $redeemarPrice;

    /**
     * @var integer
     *
     * @ORM\Column(name="redeemars_used", type="integer", nullable=false)
     */
    private $redeemarsUsed;

    /**
     * @var \AppBundle\Entity\Campaign
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Campaign")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campaign_id", referencedColumnName="id")
     * })
     */
    private $campaign;



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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Offer
     */
    public function setStartDate($startDate)
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
     * @return Offer
     */
    public function setEndDate($endDate)
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
     * Set imagePath
     *
     * @param string $imagePath
     * @return Offer
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * Get imagePath
     *
     * @return string 
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * Set prepay
     *
     * @param boolean $prepay
     * @return Offer
     */
    public function setPrepay($prepay)
    {
        $this->prepay = $prepay;

        return $this;
    }

    /**
     * Get prepay
     *
     * @return boolean 
     */
    public function getPrepay()
    {
        return $this->prepay;
    }

    /**
     * Set payOnValidate
     *
     * @param boolean $payOnValidate
     * @return Offer
     */
    public function setPayOnValidate($payOnValidate)
    {
        $this->payOnValidate = $payOnValidate;

        return $this;
    }

    /**
     * Get payOnValidate
     *
     * @return boolean 
     */
    public function getPayOnValidate()
    {
        return $this->payOnValidate;
    }

    /**
     * Set fixedAmount
     *
     * @param string $fixedAmount
     * @return Offer
     */
    public function setFixedAmount($fixedAmount)
    {
        $this->fixedAmount = $fixedAmount;

        return $this;
    }

    /**
     * Get fixedAmount
     *
     * @return string 
     */
    public function getFixedAmount()
    {
        return $this->fixedAmount;
    }

    /**
     * Set percentage
     *
     * @param integer $percentage
     * @return Offer
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * Get percentage
     *
     * @return integer 
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * Set redeemarsForValidation
     *
     * @param integer $redeemarsForValidation
     * @return Offer
     */
    public function setRedeemarsForValidation($redeemarsForValidation)
    {
        $this->redeemarsForValidation = $redeemarsForValidation;

        return $this;
    }

    /**
     * Get redeemarsForValidation
     *
     * @return integer 
     */
    public function getRedeemarsForValidation()
    {
        return $this->redeemarsForValidation;
    }

    /**
     * Set redeemarPrice
     *
     * @param string $redeemarPrice
     * @return Offer
     */
    public function setRedeemarPrice($redeemarPrice)
    {
        $this->redeemarPrice = $redeemarPrice;

        return $this;
    }

    /**
     * Get redeemarPrice
     *
     * @return string 
     */
    public function getRedeemarPrice()
    {
        return $this->redeemarPrice;
    }

    /**
     * Set redeemarsUsed
     *
     * @param integer $redeemarsUsed
     * @return Offer
     */
    public function setRedeemarsUsed($redeemarsUsed)
    {
        $this->redeemarsUsed = $redeemarsUsed;

        return $this;
    }

    /**
     * Get redeemarsUsed
     *
     * @return integer 
     */
    public function getRedeemarsUsed()
    {
        return $this->redeemarsUsed;
    }

    /**
     * Set campaign
     *
     * @param \AppBundle\Entity\Campaign $campaign
     * @return Offer
     */
    public function setCampaign(\AppBundle\Entity\Campaign $campaign = null)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * Get campaign
     *
     * @return \AppBundle\Entity\Campaign 
     */
    public function getCampaign()
    {
        return $this->campaign;
    }    
}
