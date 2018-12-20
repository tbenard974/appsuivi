<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departement
 *
 * @ORM\Table(name="departement")
 * @ORM\Entity
 */
class Departement
{
    /**
     * @var int
     *
     * @ORM\Column(name="dep_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="departement_dep_id_seq", allocationSize=1, initialValue=1)
     */
    private $depId;

    /**
     * @var string
     *
     * @ORM\Column(name="dep_nom", type="string", length=50, nullable=false)
     */
    private $depNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dep_description", type="string", length=200, nullable=true)
     */
    private $depDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="dep_auteurcreation", type="string", length=50, nullable=false)
     */
    private $depAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dep_datecreation", type="datetime", nullable=false)
     */
    private $depDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="dep_auteurchangement", type="string", length=50, nullable=false)
     */
    private $depAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dep_datechangement", type="datetime", nullable=false)
     */
    private $depDatechangement;

    public function getDepId(): ?int
    {
        return $this->depId;
    }

    public function getDepNom(): ?string
    {
        return $this->depNom;
    }

    public function setDepNom(string $depNom): self
    {
        $this->depNom = $depNom;

        return $this;
    }

    public function getDepDescription(): ?string
    {
        return $this->depDescription;
    }

    public function setDepDescription(?string $depDescription): self
    {
        $this->depDescription = $depDescription;

        return $this;
    }

    public function getDepAuteurcreation(): ?string
    {
        return $this->depAuteurcreation;
    }

    public function setDepAuteurcreation(string $depAuteurcreation): self
    {
        $this->depAuteurcreation = $depAuteurcreation;

        return $this;
    }

    public function getDepDatecreation(): ?\DateTimeInterface
    {
        return $this->depDatecreation;
    }

    public function setDepDatecreation(\DateTimeInterface $depDatecreation): self
    {
        $this->depDatecreation = $depDatecreation;

        return $this;
    }

    public function getDepAuteurchangement(): ?string
    {
        return $this->depAuteurchangement;
    }

    public function setDepAuteurchangement(string $depAuteurchangement): self
    {
        $this->depAuteurchangement = $depAuteurchangement;

        return $this;
    }

    public function getDepDatechangement(): ?\DateTimeInterface
    {
        return $this->depDatechangement;
    }

    public function setDepDatechangement(\DateTimeInterface $depDatechangement): self
    {
        $this->depDatechangement = $depDatechangement;

        return $this;
    }

    public function setUpdateFields($username)
    {
        $this->setDepDatechangement(new \DateTime(date('Y-m-d H:i:s')));
        $this->setDepAuteurchangement($username);

        if($this->getDepDatecreation() == null)
        {
            $this->setDepDatecreation(new \DateTime(date('Y-m-d H:i:s')));
        }
        if($this->getDepAuteurcreation() == null)
        {
            $this->setDepAuteurcreation($username);
        }
    }

}
