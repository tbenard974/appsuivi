<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Localisationcompetition
 *
 * @ORM\Table(name="localisationcompetition")
 * @ORM\Entity
 */
class Localisationcompetition
{
    /**
     * @var int
     *
     * @ORM\Column(name="loccom_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="localisationcompetition_loccom_id_seq", allocationSize=1, initialValue=1)
     */
    private $loccomId;

    /**
     * @var string
     *
     * @ORM\Column(name="loccom_nom", type="string", length=50, nullable=false)
     */
    private $loccomNom;

    /**
     * @var string
     *
     * @ORM\Column(name="loccom_auteurcreation", type="string", length=50, nullable=false)
     */
    private $loccomAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="loccom_datecreation", type="datetime", nullable=false)
     */
    private $loccomDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="loccom_auteurchangement", type="string", length=50, nullable=false)
     */
    private $loccomAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="loccom_datechangement", type="datetime", nullable=false)
     */
    private $loccomDatechangement;

    /**
     * @var string
     *
     * @ORM\Column(name="loccom_type", type="string", length=50, nullable=false)
     */
    private $loccomType;

    public function getLoccomId(): ?int
    {
        return $this->loccomId;
    }

    public function getLoccomNom(): ?string
    {
        return $this->loccomNom;
    }

    public function setLoccomNom(string $loccomNom): self
    {
        $this->loccomNom = $loccomNom;

        return $this;
    }

    public function getLoccomAuteurcreation(): ?string
    {
        return $this->loccomAuteurcreation;
    }

    public function setLoccomAuteurcreation(string $loccomAuteurcreation): self
    {
        $this->loccomAuteurcreation = $loccomAuteurcreation;

        return $this;
    }

    public function getLoccomDatecreation(): ?\DateTimeInterface
    {
        return $this->loccomDatecreation;
    }

    public function setLoccomDatecreation(\DateTimeInterface $loccomDatecreation): self
    {
        $this->loccomDatecreation = $loccomDatecreation;

        return $this;
    }

    public function getLoccomAuteurchangement(): ?string
    {
        return $this->loccomAuteurchangement;
    }

    public function setLoccomAuteurchangement(string $loccomAuteurchangement): self
    {
        $this->loccomAuteurchangement = $loccomAuteurchangement;

        return $this;
    }

    public function getLoccomDatechangement(): ?\DateTimeInterface
    {
        return $this->loccomDatechangement;
    }

    public function setLoccomDatechangement(\DateTimeInterface $loccomDatechangement): self
    {
        $this->loccomDatechangement = $loccomDatechangement;

        return $this;
    }

    public function getLoccomType(): ?string
    {
        return $this->loccomType;
    }

    public function setLoccomType(string $loccomType): self
    {
        $this->loccomType = $loccomType;

        return $this;
    }


}
