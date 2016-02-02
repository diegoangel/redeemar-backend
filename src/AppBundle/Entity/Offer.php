<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Table(name="offer", indexes={@ORM\Index(name="idx_campaign_name", columns={"campaign_name"}), @ORM\Index(name="idx_start_date", columns={"start_date"}), @ORM\Index(name="idx_end_date", columns={"end_date"})})
 * @ORM\Entity
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
     * @var string
     *
     * @ORM\Column(name="campaign_name", type="string", length=255, nullable=false)
     */
    private $campaignName;

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


}
