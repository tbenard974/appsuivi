<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Division
 *
 * @ORM\Table(name="division")
 * @ORM\Entity
 */
class Division
{
    /**
     * @var int
     *
     * @ORM\Column(name="div_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="division_div_id_seq", allocationSize=1, initialValue=1)
     */
    private $divId;

    /**
     * @var string
     *
     * @ORM\Column(name="div_name", type="string", length=50, nullable=false)
     */
    private $divName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="div_description", type="string", length=200, nullable=true)
     */
    private $divDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="div_auteurcreation", type="string", length=50, nullable=false)
     */
    private $divAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="div_datecreation", type="datetime", nullable=false)
     */
    private $divDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="div_auteurchangement", type="string", length=50, nullable=false)
     */
    private $divAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="div_datechangement", type="datetime", nullable=false)
     */
    private $divDatechangement;

    public function getDivId(): ?int
    {
        return $this->divId;
    }

    public function getDivName(): ?string
    {
        return $this->divName;
    }

    public function setDivName(string $divName): self
    {
        $this->divName = $divName;

        return $this;
    }

    public function getDivDescription(): ?string
    {
        return $this->divDescription;
    }

    public function setDivDescription(?string $divDescription): self
    {
        $this->divDescription = $divDescription;

        return $this;
    }

    public function getDivAuteurcreation(): ?string
    {
        return $this->divAuteurcreation;
    }

    public function setDivAuteurcreation(string $divAuteurcreation): self
    {
        $this->divAuteurcreation = $divAuteurcreation;

        return $this;
    }

    public function getDivDatecreation(): ?\DateTimeInterface
    {
        return $this->divDatecreation;
    }

    public function setDivDatecreation(\DateTimeInterface $divDatecreation): self
    {
        $this->divDatecreation = $divDatecreation;

        return $this;
    }

    public function getDivAuteurchangement(): ?string
    {
        return $this->divAuteurchangement;
    }

    public function setDivAuteurchangement(string $divAuteurchangement): self
    {
        $this->divAuteurchangement = $divAuteurchangement;

        return $this;
    }

    public function getDivDatechangement(): ?\DateTimeInterface
    {
        return $this->divDatechangement;
    }

    public function setDivDatechangement(\DateTimeInterface $divDatechangement): self
    {
        $this->divDatechangement = $divDatechangement;

        return $this;
    }


}
