<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Niveaucompetition
 *
 * @ORM\Table(name="niveaucompetition")
 * @ORM\Entity
 */
class Niveaucompetition
{
    /**
     * @var int
     *
     * @ORM\Column(name="nivcom_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="niveaucompetition_nivcom_id_seq", allocationSize=1, initialValue=1)
     */
    private $nivcomId;

    /**
     * @var string
     *
     * @ORM\Column(name="nivcom_name", type="string", length=50, nullable=false)
     */
    private $nivcomName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nivcom_description", type="string", length=200, nullable=true)
     */
    private $nivcomDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="nivcom_auteurcreation", type="string", length=50, nullable=false)
     */
    private $nivcomAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nivcom_datecreation", type="datetime", nullable=false)
     */
    private $nivcomDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="nivcom_auteurchangement", type="string", length=50, nullable=false)
     */
    private $nivcomAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nivcom_datechangement", type="datetime", nullable=false)
     */
    private $nivcomDatechangement;

    public function getNivcomId(): ?int
    {
        return $this->nivcomId;
    }

    public function getNivcomName(): ?string
    {
        return $this->nivcomName;
    }

    public function setNivcomName(string $nivcomName): self
    {
        $this->nivcomName = $nivcomName;

        return $this;
    }

    public function getNivcomDescription(): ?string
    {
        return $this->nivcomDescription;
    }

    public function setNivcomDescription(?string $nivcomDescription): self
    {
        $this->nivcomDescription = $nivcomDescription;

        return $this;
    }

    public function getNivcomAuteurcreation(): ?string
    {
        return $this->nivcomAuteurcreation;
    }

    public function setNivcomAuteurcreation(string $nivcomAuteurcreation): self
    {
        $this->nivcomAuteurcreation = $nivcomAuteurcreation;

        return $this;
    }

    public function getNivcomDatecreation(): ?\DateTimeInterface
    {
        return $this->nivcomDatecreation;
    }

    public function setNivcomDatecreation(\DateTimeInterface $nivcomDatecreation): self
    {
        $this->nivcomDatecreation = $nivcomDatecreation;

        return $this;
    }

    public function getNivcomAuteurchangement(): ?string
    {
        return $this->nivcomAuteurchangement;
    }

    public function setNivcomAuteurchangement(string $nivcomAuteurchangement): self
    {
        $this->nivcomAuteurchangement = $nivcomAuteurchangement;

        return $this;
    }

    public function getNivcomDatechangement(): ?\DateTimeInterface
    {
        return $this->nivcomDatechangement;
    }

    public function setNivcomDatechangement(\DateTimeInterface $nivcomDatechangement): self
    {
        $this->nivcomDatechangement = $nivcomDatechangement;

        return $this;
    }


}
