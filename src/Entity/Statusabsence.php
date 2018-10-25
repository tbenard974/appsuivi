<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statusabsence
 *
 * @ORM\Table(name="statusabsence")
 * @ORM\Entity
 */
class Statusabsence
{
    /**
     * @var int
     *
     * @ORM\Column(name="staabs_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="statusabsence_staabs_id_seq", allocationSize=1, initialValue=1)
     */
    private $staabsId;

    /**
     * @var string
     *
     * @ORM\Column(name="staabs_nom", type="string", length=30, nullable=false)
     */
    private $staabsNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="staabs_description", type="string", length=200, nullable=true)
     */
    private $staabsDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="staabs_auteurcreation", type="string", length=50, nullable=false)
     */
    private $staabsAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="staabs_datecreation", type="datetime", nullable=false)
     */
    private $staabsDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="staabs_auteurchangement", type="string", length=50, nullable=false)
     */
    private $staabsAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="staabs_datechangement", type="datetime", nullable=false)
     */
    private $staabsDatechangement;

    public function getStaabsId(): ?int
    {
        return $this->staabsId;
    }

    public function getStaabsNom(): ?string
    {
        return $this->staabsNom;
    }

    public function setStaabsNom(string $staabsNom): self
    {
        $this->staabsNom = $staabsNom;

        return $this;
    }

    public function getStaabsDescription(): ?string
    {
        return $this->staabsDescription;
    }

    public function setStaabsDescription(?string $staabsDescription): self
    {
        $this->staabsDescription = $staabsDescription;

        return $this;
    }

    public function getStaabsAuteurcreation(): ?string
    {
        return $this->staabsAuteurcreation;
    }

    public function setStaabsAuteurcreation(string $staabsAuteurcreation): self
    {
        $this->staabsAuteurcreation = $staabsAuteurcreation;

        return $this;
    }

    public function getStaabsDatecreation(): ?\DateTimeInterface
    {
        return $this->staabsDatecreation;
    }

    public function setStaabsDatecreation(\DateTimeInterface $staabsDatecreation): self
    {
        $this->staabsDatecreation = $staabsDatecreation;

        return $this;
    }

    public function getStaabsAuteurchangement(): ?string
    {
        return $this->staabsAuteurchangement;
    }

    public function setStaabsAuteurchangement(string $staabsAuteurchangement): self
    {
        $this->staabsAuteurchangement = $staabsAuteurchangement;

        return $this;
    }

    public function getStaabsDatechangement(): ?\DateTimeInterface
    {
        return $this->staabsDatechangement;
    }

    public function setStaabsDatechangement(\DateTimeInterface $staabsDatechangement): self
    {
        $this->staabsDatechangement = $staabsDatechangement;

        return $this;
    }


}
