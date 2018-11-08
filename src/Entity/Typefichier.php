<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typefichier
 *
 * @ORM\Table(name="typefichier")
 * @ORM\Entity
 */
class Typefichier
{
    /**
     * @var int
     *
     * @ORM\Column(name="typfic_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="typefichier_typfic_id_seq", allocationSize=1, initialValue=1)
     */
    private $typficId;

    /**
     * @var string
     *
     * @ORM\Column(name="typfic_nom", type="string", length=50, nullable=false)
     */
    private $typficNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="typfic_description", type="string", length=200, nullable=true)
     */
    private $typficDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="typfic_auteurcreation", type="string", length=50, nullable=false)
     */
    private $typficAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="typfic_datecreation", type="datetime", nullable=false)
     */
    private $typficDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="typfic_auteurchangement", type="string", length=50, nullable=false)
     */
    private $typficAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="typfic_datechangement", type="datetime", nullable=false)
     */
    private $typficDatechangement;

    public function getTypficId(): ?int
    {
        return $this->typficId;
    }

    public function getTypficNom(): ?string
    {
        return $this->typficNom;
    }

    public function setTypficNom(string $typficNom): self
    {
        $this->typficNom = $typficNom;

        return $this;
    }

    public function getTypficDescription(): ?string
    {
        return $this->typficDescription;
    }

    public function setTypficDescription(?string $typficDescription): self
    {
        $this->typficDescription = $typficDescription;

        return $this;
    }

    public function getTypficAuteurcreation(): ?string
    {
        return $this->typficAuteurcreation;
    }

    public function setTypficAuteurcreation(string $typficAuteurcreation): self
    {
        $this->typficAuteurcreation = $typficAuteurcreation;

        return $this;
    }

    public function getTypficDatecreation(): ?\DateTimeInterface
    {
        return $this->typficDatecreation;
    }

    public function setTypficDatecreation(\DateTimeInterface $typficDatecreation): self
    {
        $this->typficDatecreation = $typficDatecreation;

        return $this;
    }

    public function getTypficAuteurchangement(): ?string
    {
        return $this->typficAuteurchangement;
    }

    public function setTypficAuteurchangement(string $typficAuteurchangement): self
    {
        $this->typficAuteurchangement = $typficAuteurchangement;

        return $this;
    }

    public function getTypficDatechangement(): ?\DateTimeInterface
    {
        return $this->typficDatechangement;
    }

    public function setTypficDatechangement(\DateTimeInterface $typficDatechangement): self
    {
        $this->typficDatechangement = $typficDatechangement;

        return $this;
    }


}
