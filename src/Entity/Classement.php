<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classement
 *
 * @ORM\Table(name="classement")
 * @ORM\Entity
 */
class Classement
{
    /**
     * @var int
     *
     * @ORM\Column(name="cla_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="classement_cla_id_seq", allocationSize=1, initialValue=1)
     */
    private $claId;

    /**
     * @var string
     *
     * @ORM\Column(name="cla_name", type="string", length=50, nullable=false)
     */
    private $claName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cla_description", type="string", length=200, nullable=true)
     */
    private $claDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="cla_auteurcreation", type="string", length=50, nullable=false)
     */
    private $claAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cla_datecreation", type="datetime", nullable=false)
     */
    private $claDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="cla_auteurchangement", type="string", length=50, nullable=false)
     */
    private $claAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cla_datechangement", type="datetime", nullable=false)
     */
    private $claDatechangement;

    public function getClaId(): ?int
    {
        return $this->claId;
    }

    public function getClaName(): ?string
    {
        return $this->claName;
    }

    public function setClaName(string $claName): self
    {
        $this->claName = $claName;

        return $this;
    }

    public function getClaDescription(): ?string
    {
        return $this->claDescription;
    }

    public function setClaDescription(?string $claDescription): self
    {
        $this->claDescription = $claDescription;

        return $this;
    }

    public function getClaAuteurcreation(): ?string
    {
        return $this->claAuteurcreation;
    }

    public function setClaAuteurcreation(string $claAuteurcreation): self
    {
        $this->claAuteurcreation = $claAuteurcreation;

        return $this;
    }

    public function getClaDatecreation(): ?\DateTimeInterface
    {
        return $this->claDatecreation;
    }

    public function setClaDatecreation(\DateTimeInterface $claDatecreation): self
    {
        $this->claDatecreation = $claDatecreation;

        return $this;
    }

    public function getClaAuteurchangement(): ?string
    {
        return $this->claAuteurchangement;
    }

    public function setClaAuteurchangement(string $claAuteurchangement): self
    {
        $this->claAuteurchangement = $claAuteurchangement;

        return $this;
    }

    public function getClaDatechangement(): ?\DateTimeInterface
    {
        return $this->claDatechangement;
    }

    public function setClaDatechangement(\DateTimeInterface $claDatechangement): self
    {
        $this->claDatechangement = $claDatechangement;

        return $this;
    }


}
