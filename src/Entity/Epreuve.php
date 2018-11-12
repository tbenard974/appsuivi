<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Epreuve
 *
 * @ORM\Table(name="epreuve")
 * @ORM\Entity
 */
class Epreuve
{
    /**
     * @var int
     *
     * @ORM\Column(name="epr_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="epreuve_epr_id_seq", allocationSize=1, initialValue=1)
     */
    private $eprId;

    /**
     * @var string
     *
     * @ORM\Column(name="epr_nom", type="string", length=50, nullable=false)
     */
    private $eprNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="epr_description", type="string", length=200, nullable=true)
     */
    private $eprDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="epr_auteurcreation", type="string", length=50, nullable=false)
     */
    private $eprAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="epr_datecreation", type="datetime", nullable=false)
     */
    private $eprDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="epr_auteurchangement", type="string", length=50, nullable=false)
     */
    private $eprAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="epr_datechangement", type="datetime", nullable=false)
     */
    private $eprDatechangement;

    public function getEprId(): ?int
    {
        return $this->eprId;
    }

    public function getEprNom(): ?string
    {
        return $this->eprNom;
    }

    public function setEprNom(string $eprNom): self
    {
        $this->eprNom = $eprNom;

        return $this;
    }

    public function getEprDescription(): ?string
    {
        return $this->eprDescription;
    }

    public function setEprDescription(?string $eprDescription): self
    {
        $this->eprDescription = $eprDescription;

        return $this;
    }

    public function getEprAuteurcreation(): ?string
    {
        return $this->eprAuteurcreation;
    }

    public function setEprAuteurcreation(string $eprAuteurcreation): self
    {
        $this->eprAuteurcreation = $eprAuteurcreation;

        return $this;
    }

    public function getEprDatecreation(): ?\DateTimeInterface
    {
        return $this->eprDatecreation;
    }

    public function setEprDatecreation(\DateTimeInterface $eprDatecreation): self
    {
        $this->eprDatecreation = $eprDatecreation;

        return $this;
    }

    public function getEprAuteurchangement(): ?string
    {
        return $this->eprAuteurchangement;
    }

    public function setEprAuteurchangement(string $eprAuteurchangement): self
    {
        $this->eprAuteurchangement = $eprAuteurchangement;

        return $this;
    }

    public function getEprDatechangement(): ?\DateTimeInterface
    {
        return $this->eprDatechangement;
    }

    public function setEprDatechangement(\DateTimeInterface $eprDatechangement): self
    {
        $this->eprDatechangement = $eprDatechangement;

        return $this;
    }


}
