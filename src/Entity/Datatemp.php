<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DataTemp
 *
 * @ORM\Table(name="dataTemp")
 * @ORM\Entity
 */
class DataTemp
{
    /**
     * @var int
     *
     * @ORM\Column(name="dattem_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="dataTemp_dattem_id_seq", allocationSize=1, initialValue=1)
     */
    private $dattemId;

    /**
     * @var string
     *
     * @ORM\Column(name="dattem_nom", type="string", length=50, nullable=false)
     */
    private $dattemNom;

    /**
     * @var string
     *
     * @ORM\Column(name="dattem_auteurcreation", type="string", length=50, nullable=false)
     */
    private $dattemAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dattem_datecreation", type="datetime", nullable=false)
     */
    private $dattemDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="dattem_auteurchangement", type="string", length=50, nullable=false)
     */
    private $dattemAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dattem_datechangement", type="datetime", nullable=false)
     */
    private $dattemDatechangement;

    /**
     * @var string
     *
     * @ORM\Column(name="dattem_type", type="string", length=50, nullable=false)
     */
    private $dattemType;

    public function getdattemId(): ?int
    {
        return $this->dattemId;
    }

    public function getdattemNom(): ?string
    {
        return $this->dattemNom;
    }

    public function setdattemNom(string $dattemNom): self
    {
        $this->dattemNom = $dattemNom;

        return $this;
    }

    public function getdattemAuteurcreation(): ?string
    {
        return $this->dattemAuteurcreation;
    }

    public function setdattemAuteurcreation(string $dattemAuteurcreation): self
    {
        $this->dattemAuteurcreation = $dattemAuteurcreation;

        return $this;
    }

    public function getdattemDatecreation(): ?\DateTimeInterface
    {
        return $this->dattemDatecreation;
    }

    public function setdattemDatecreation(\DateTimeInterface $dattemDatecreation): self
    {
        $this->dattemDatecreation = $dattemDatecreation;

        return $this;
    }

    public function getdattemAuteurchangement(): ?string
    {
        return $this->dattemAuteurchangement;
    }

    public function setdattemAuteurchangement(string $dattemAuteurchangement): self
    {
        $this->dattemAuteurchangement = $dattemAuteurchangement;

        return $this;
    }

    public function getdattemDatechangement(): ?\DateTimeInterface
    {
        return $this->dattemDatechangement;
    }

    public function setdattemDatechangement(\DateTimeInterface $dattemDatechangement): self
    {
        $this->dattemDatechangement = $dattemDatechangement;

        return $this;
    }

    public function getdattemType(): ?string
    {
        return $this->dattemType;
    }

    public function setdattemType(string $dattemType): self
    {
        $this->dattemType = $dattemType;

        return $this;
    }


}
