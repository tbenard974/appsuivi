<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resultat
 *
 * @ORM\Table(name="resultat")
 * @ORM\Entity
 */
class Resultat
{
    /**
     * @var int
     *
     * @ORM\Column(name="res_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="resultat_res_id_seq", allocationSize=1, initialValue=1)
     */
    private $resId;

    /**
     * @var string
     *
     * @ORM\Column(name="res_nom", type="string", length=50, nullable=false)
     */
    private $resNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="res_description", type="string", length=200, nullable=true)
     */
    private $resDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="res_auteurcreation", type="string", length=50, nullable=false)
     */
    private $resAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="res_datecreation", type="datetime", nullable=false)
     */
    private $resDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="res_auteurchangement", type="string", length=50, nullable=false)
     */
    private $resAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="res_datechangement", type="datetime", nullable=false)
     */
    private $resDatechangement;

    public function getResId(): ?int
    {
        return $this->resId;
    }

    public function getResNom(): ?string
    {
        return $this->resNom;
    }

    public function setResNom(string $resNom): self
    {
        $this->resNom = $resNom;

        return $this;
    }

    public function getResDescription(): ?string
    {
        return $this->resDescription;
    }

    public function setResDescription(?string $resDescription): self
    {
        $this->resDescription = $resDescription;

        return $this;
    }

    public function getResAuteurcreation(): ?string
    {
        return $this->resAuteurcreation;
    }

    public function setResAuteurcreation(string $resAuteurcreation): self
    {
        $this->resAuteurcreation = $resAuteurcreation;

        return $this;
    }

    public function getResDatecreation(): ?\DateTimeInterface
    {
        return $this->resDatecreation;
    }

    public function setResDatecreation(\DateTimeInterface $resDatecreation): self
    {
        $this->resDatecreation = $resDatecreation;

        return $this;
    }

    public function getResAuteurchangement(): ?string
    {
        return $this->resAuteurchangement;
    }

    public function setResAuteurchangement(string $resAuteurchangement): self
    {
        $this->resAuteurchangement = $resAuteurchangement;

        return $this;
    }

    public function getResDatechangement(): ?\DateTimeInterface
    {
        return $this->resDatechangement;
    }

    public function setResDatechangement(\DateTimeInterface $resDatechangement): self
    {
        $this->resDatechangement = $resDatechangement;

        return $this;
    }


}
