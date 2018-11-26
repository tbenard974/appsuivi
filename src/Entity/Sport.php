<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sport
 *
 * @ORM\Table(name="sport")
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
     * @ORM\Column(name="spo_nom", type="string", length=50, nullable=false)
     */
    private $spoNom;

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

    public function getSpoId(): ?int
    {
        return $this->spoId;
    }

    public function getSpoNom(): ?string
    {
        return $this->spoNom;
    }

    public function setSpoNom(string $spoNom): self
    {
        $this->spoNom = $spoNom;

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

    public function setUpdateFields($username)
    {
        $this->setSpoDatechangement(new \DateTime(date('Y-m-d H:i:s')));
        $this->setSpoAuteurchangement($username);

        if($this->getSpoDatecreation() == null)
        {
            $this->setSpoDatecreation(new \DateTime(date('Y-m-d H:i:s')));
        }
        if($this->getSpoAuteurcreation() == null)
        {
            $this->setSpoAuteurcreation($username);
        }
    }
}
