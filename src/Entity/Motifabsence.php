<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Motifabsence
 *
 * @ORM\Table(name="motifabsence")
 * @ORM\Entity
 */
class Motifabsence
{
    /**
     * @var int
     *
     * @ORM\Column(name="motabs_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="motifabsence_motabs_id_seq", allocationSize=1, initialValue=1)
     */
    private $motabsId;

    /**
     * @var string
     *
     * @ORM\Column(name="motabs_name", type="string", length=50, nullable=false)
     */
    private $motabsName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="motabs_description", type="string", length=200, nullable=true)
     */
    private $motabsDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="motabs_auteurcreation", type="string", length=50, nullable=false)
     */
    private $motabsAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="motabs_datecreation", type="datetime", nullable=false)
     */
    private $motabsDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="motabs_auteurchangement", type="string", length=50, nullable=false)
     */
    private $motabsAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="motabs_datechangement", type="datetime", nullable=false)
     */
    private $motabsDatechangement;

    public function getMotabsId(): ?int
    {
        return $this->motabsId;
    }

    public function getMotabsName(): ?string
    {
        return $this->motabsName;
    }

    public function setMotabsName(string $motabsName): self
    {
        $this->motabsName = $motabsName;

        return $this;
    }

    public function getMotabsDescription(): ?string
    {
        return $this->motabsDescription;
    }

    public function setMotabsDescription(?string $motabsDescription): self
    {
        $this->motabsDescription = $motabsDescription;

        return $this;
    }

    public function getMotabsAuteurcreation(): ?string
    {
        return $this->motabsAuteurcreation;
    }

    public function setMotabsAuteurcreation(string $motabsAuteurcreation): self
    {
        $this->motabsAuteurcreation = $motabsAuteurcreation;

        return $this;
    }

    public function getMotabsDatecreation(): ?\DateTimeInterface
    {
        return $this->motabsDatecreation;
    }

    public function setMotabsDatecreation(\DateTimeInterface $motabsDatecreation): self
    {
        $this->motabsDatecreation = $motabsDatecreation;

        return $this;
    }

    public function getMotabsAuteurchangement(): ?string
    {
        return $this->motabsAuteurchangement;
    }

    public function setMotabsAuteurchangement(string $motabsAuteurchangement): self
    {
        $this->motabsAuteurchangement = $motabsAuteurchangement;

        return $this;
    }

    public function getMotabsDatechangement(): ?\DateTimeInterface
    {
        return $this->motabsDatechangement;
    }

    public function setMotabsDatechangement(\DateTimeInterface $motabsDatechangement): self
    {
        $this->motabsDatechangement = $motabsDatechangement;

        return $this;
    }


}
