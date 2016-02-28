<?php

namespace Redeemar\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Logo
 *
 * @ORM\Table(name="logo")
 * @ORM\Entity(repositoryClass="Redeemar\Entity\LogoRepository")
 */
class Logo
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
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=false)
     */
    private $path;

    /**
    * @var \Redeemar\Entity\Company
    *
    * @ORM\ManyToOne(targetEntity="\Redeemar\Entity\Company", inversedBy="logos")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="company_id", referencedColumnName="id")
    * })
    */
    private $company;



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
     * Set path
     *
     * @param string $path
     * @return Logo
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Logo
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
     * Set company
     *
     * @param \Redeemar\Entity\Company $company
     *
     * @return Logo
     */
    public function setCompany(\Redeemar\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Redeemar\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }
}
