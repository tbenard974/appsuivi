<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sport
 *
 * @ORM\Table(name="sport", indexes={@ORM\Index(name="IDX_1A85EFD21B02A3C1", columns={"spo_fk_idtypesport"})})
 * @ORM\Entity
 */
class Sport
{
    /**
     * @var int
     *
     * @ORM\Column(name="spo_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sport_spo_id_seq", allocationSize=1, initialValue=1)
     */
    private $spoId;

    /**
     * @var string
     *
     * @ORM\Column(name="spo_name", type="string", length=50, nullable=false)
     */
    private $spoName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="spo_description", type="string", length=200, nullable=true)
     */
    private $spoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="spo_auteurcreation", type="string", length=50, nullable=false)
     */
    private $spoAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="spo_datecreation", type="datetime", nullable=false)
     */
    private $spoDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="spo_auteurchangement", type="string", length=50, nullable=false)
     */
    private $spoAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="spo_datechangement", type="datetime", nullable=false)
     */
    private $spoDatechangement;

    /**
     * @var \Typesport
     *
     * @ORM\ManyToOne(targetEntity="Typesport")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="spo_fk_idtypesport", referencedColumnName="typspo_id")
     * })
     */
    private $spoFktypesport;

    public function getSpoId(): ?int
    {
        return $this->spoId;
    }

    public function getSpoName(): ?string
    {
        return $this->spoName;
    }

    public function setSpoName(string $spoName): self
    {
        $this->spoName = $spoName;

        return $this;
    }

    public function getSpoDescription(): ?string
    {
        return $this->spoDescription;
    }

    public function setSpoDescription(?string $spoDescription): self
    {
        $this->spoDescription = $spoDescription;

        return $this;
    }

    public function getSpoAuteurcreation(): ?string
    {
        return $this->spoAuteurcreation;
    }

    public function setSpoAuteurcreation(string $spoAuteurcreation): self
    {
        $this->spoAuteurcreation = $spoAuteurcreation;

        return $this;
    }

    public function getSpoDatecreation(): ?\DateTimeInterface
    {
        return $this->spoDatecreation;
    }

    public function setSpoDatecreation(\DateTimeInterface $spoDatecreation): self
    {
        $this->spoDatecreation = $spoDatecreation;

        return $this;
    }

    public function getSpoAuteurchangement(): ?string
    {
        return $this->spoAuteurchangement;
    }

    public function setSpoAuteurchangement(string $spoAuteurchangement): self
    {
        $this->spoAuteurchangement = $spoAuteurchangement;

        return $this;
    }

    public function getSpoDatechangement(): ?\DateTimeInterface
    {
        return $this->spoDatechangement;
    }

    public function setSpoDatechangement(\DateTimeInterface $spoDatechangement): self
    {
        $this->spoDatechangement = $spoDatechangement;

        return $this;
    }

    public function getSpoFktypesport(): ?Typesport
    {
        return $this->spoFktypesport;
    }

    public function setSpoFktypesport(?Typesport $spoFktypesport): self
    {
        $this->spoFktypesport = $spoFktypesport;

        return $this;
    }


}
