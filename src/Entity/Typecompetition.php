<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typecompetition
 *
 * @ORM\Table(name="typecompetition")
 * @ORM\Entity
 */
class Typecompetition
{
    /**
     * @var int
     *
     * @ORM\Column(name="typcom_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="typecompetition_typcom_id_seq", allocationSize=1, initialValue=1)
     */
    private $typcomId;

    /**
     * @var string
     *
     * @ORM\Column(name="typcom_nom", type="string", length=50, nullable=false)
     */
    private $typcomNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="typcom_description", type="string", length=200, nullable=true)
     */
    private $typcomDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="typcom_auteurcreation", type="string", length=50, nullable=false)
     */
    private $typcomAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="typcom_datecreation", type="datetime", nullable=false)
     */
    private $typcomDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="typcom_auteurchangement", type="string", length=50, nullable=false)
     */
    private $typcomAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="typcom_datechangement", type="datetime", nullable=false)
     */
    private $typcomDatechangement;

    public function getTypcomId(): ?int
    {
        return $this->typcomId;
    }

    public function getTypcomNom(): ?string
    {
        return $this->typcomNom;
    }

    public function setTypcomNom(string $typcomNom): self
    {
        $this->typcomNom = $typcomNom;

        return $this;
    }

    public function getTypcomDescription(): ?string
    {
        return $this->typcomDescription;
    }

    public function setTypcomDescription(?string $typcomDescription): self
    {
        $this->typcomDescription = $typcomDescription;

        return $this;
    }

    public function getTypcomAuteurcreation(): ?string
    {
        return $this->typcomAuteurcreation;
    }

    public function setTypcomAuteurcreation(string $typcomAuteurcreation): self
    {
        $this->typcomAuteurcreation = $typcomAuteurcreation;

        return $this;
    }

    public function getTypcomDatecreation(): ?\DateTimeInterface
    {
        return $this->typcomDatecreation;
    }

    public function setTypcomDatecreation(\DateTimeInterface $typcomDatecreation): self
    {
        $this->typcomDatecreation = $typcomDatecreation;

        return $this;
    }

    public function getTypcomAuteurchangement(): ?string
    {
        return $this->typcomAuteurchangement;
    }

    public function setTypcomAuteurchangement(string $typcomAuteurchangement): self
    {
        $this->typcomAuteurchangement = $typcomAuteurchangement;

        return $this;
    }

    public function getTypcomDatechangement(): ?\DateTimeInterface
    {
        return $this->typcomDatechangement;
    }

    public function setTypcomDatechangement(\DateTimeInterface $typcomDatechangement): self
    {
        $this->typcomDatechangement = $typcomDatechangement;

        return $this;
    }


}
