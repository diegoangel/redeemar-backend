<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyBillingInformation
 *
 * @ORM\Table(name="company_billing_information", indexes={@ORM\Index(name="fk_company_id", columns={"company_id"})})
 * @ORM\Entity
 */
class CompanyBillingInformation
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
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer", length=6, nullable=true)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="apartment", type="string", length=10, nullable=true)
     */
    private $apartment;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=10, nullable=true)
     */
    private $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="country", )
     */
    private $country;

    /**
     * @var \AppBundle\Entity\Company
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Company")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     * })
     */
    private $company;



}
