<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Niveaulisteministerielle
 *
 * @ORM\Table(name="niveaulisteministerielle")
 * @ORM\Entity
 */
class Niveaulisteministerielle
{
    /**
     * @var int
     *
     * @ORM\Column(name="nivlismin_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="niveaulisteministerielle_nivlismin_id_seq", allocationSize=1, initialValue=1)
     */
    private $nivlisminId;

    /**
     * @var string
     *
     * @ORM\Column(name="nivlismin_nom", type="string", length=50, nullable=false)
     */
    private $nivlisminNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nivlismin_description", type="string", length=200, nullable=true)
     */
    private $nivlisminDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="nivlismin_auteurcreation", type="string", length=50, nullable=false)
     */
    private $nivlisminAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nivlismin_datecreation", type="datetime", nullable=false)
     */
    private $nivlisminDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="nivlismin_auteurchangement", type="string", length=50, nullable=false)
     */
    private $nivlisminAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nivlismin_datechangement", type="datetime", nullable=false)
     */
    private $nivlisminDatechangement;

    public function getNivlisminId(): ?int
    {
        return $this->nivlisminId;
    }

    public function getNivlisminNom(): ?string
    {
        return $this->nivlisminNom;
    }

    public function setNivlisminNom(string $nivlisminNom): self
    {
        $this->nivlisminNom = $nivlisminNom;

        return $this;
    }

    public function getNivlisminDescription(): ?string
    {
        return $this->nivlisminDescription;
    }

    public function setNivlisminDescription(?string $nivlisminDescription): self
    {
        $this->nivlisminDescription = $nivlisminDescription;

        return $this;
    }

    public function getNivlisminAuteurcreation(): ?string
    {
        return $this->nivlisminAuteurcreation;
    }

    public function setNivlisminAuteurcreation(string $nivlisminAuteurcreation): self
    {
        $this->nivlisminAuteurcreation = $nivlisminAuteurcreation;

        return $this;
    }

    public function getNivlisminDatecreation(): ?\DateTimeInterface
    {
        return $this->nivlisminDatecreation;
    }

    public function setNivlisminDatecreation(\DateTimeInterface $nivlisminDatecreation): self
    {
        $this->nivlisminDatecreation = $nivlisminDatecreation;

        return $this;
    }

    public function getNivlisminAuteurchangement(): ?string
    {
        return $this->nivlisminAuteurchangement;
    }

    public function setNivlisminAuteurchangement(string $nivlisminAuteurchangement): self
    {
        $this->nivlisminAuteurchangement = $nivlisminAuteurchangement;

        return $this;
    }

    public function getNivlisminDatechangement(): ?\DateTimeInterface
    {
        return $this->nivlisminDatechangement;
    }

    public function setNivlisminDatechangement(\DateTimeInterface $nivlisminDatechangement): self
    {
        $this->nivlisminDatechangement = $nivlisminDatechangement;

        return $this;
    }


}
