<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ValidatorUserLog
 *
 * @ORM\Table(name="validator_user_log", indexes={@ORM\Index(name="idx_location_id", columns={"location_id"}), @ORM\Index(name="idx_date", columns={"date"}), @ORM\Index(name="idx_offer_id", columns={"offer_id"}), @ORM\Index(name="idx_user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class ValidatorUserLog
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
     * @var integer
     *
     * @ORM\Column(name="offer_id", type="integer", nullable=false)
     */
    private $offerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $amount;

    /**
     * @var integer
     *
     * @ORM\Column(name="location_id", type="integer", nullable=false)
     */
    private $locationId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;


}
