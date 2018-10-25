<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nomcompetition
 *
 * @ORM\Table(name="nomcompetition")
 * @ORM\Entity
 */
class Nomcompetition
{
    /**
     * @var int
     *
     * @ORM\Column(name="nomcom_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="nomcompetition_nomcom_id_seq", allocationSize=1, initialValue=1)
     */
    private $nomcomId;

    /**
     * @var string
     *
     * @ORM\Column(name="nomcom_name", type="string", length=50, nullable=false)
     */
    private $nomcomName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nomcom_description", type="string", length=200, nullable=true)
     */
    private $nomcomDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="nomcom_auteurcreation", type="string", length=50, nullable=false)
     */
    private $nomcomAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nomcom_datecreation", type="datetime", nullable=false)
     */
    private $nomcomDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="nomcom_auteurchangement", type="string", length=50, nullable=false)
     */
    private $nomcomAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nivcom_datechangement", type="datetime", nullable=false)
     */
    private $nivcomDatechangement;

    public function getNomcomId(): ?int
    {
        return $this->nomcomId;
    }

    public function getNomcomName(): ?string
    {
        return $this->nomcomName;
    }

    public function setNomcomName(string $nomcomName): self
    {
        $this->nomcomName = $nomcomName;

        return $this;
    }

    public function getNomcomDescription(): ?string
    {
        return $this->nomcomDescription;
    }

    public function setNomcomDescription(?string $nomcomDescription): self
    {
        $this->nomcomDescription = $nomcomDescription;

        return $this;
    }

    public function getNomcomAuteurcreation(): ?string
    {
        return $this->nomcomAuteurcreation;
    }

    public function setNomcomAuteurcreation(string $nomcomAuteurcreation): self
    {
        $this->nomcomAuteurcreation = $nomcomAuteurcreation;

        return $this;
    }

    public function getNomcomDatecreation(): ?\DateTimeInterface
    {
        return $this->nomcomDatecreation;
    }

    public function setNomcomDatecreation(\DateTimeInterface $nomcomDatecreation): self
    {
        $this->nomcomDatecreation = $nomcomDatecreation;

        return $this;
    }

    public function getNomcomAuteurchangement(): ?string
    {
        return $this->nomcomAuteurchangement;
    }

    public function setNomcomAuteurchangement(string $nomcomAuteurchangement): self
    {
        $this->nomcomAuteurchangement = $nomcomAuteurchangement;

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
