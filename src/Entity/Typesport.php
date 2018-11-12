<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typesport
 *
 * @ORM\Table(name="typesport")
 * @ORM\Entity
 */
class Typesport
{
    /**
     * @var int
     *
     * @ORM\Column(name="typspo_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="typesport_typspo_id_seq", allocationSize=1, initialValue=1)
     */
    private $typspoId;

    /**
     * @var string
     *
     * @ORM\Column(name="typspo_name", type="string", length=50, nullable=false)
     */
    private $typspoName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="typspo_description", type="string", length=200, nullable=true)
     */
    private $typspoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="typspo_auteurcreation", type="string", length=50, nullable=false)
     */
    private $typspoAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="typspo_datecreation", type="datetime", nullable=false)
     */
    private $typspoDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="typspo_auteurchangement", type="string", length=50, nullable=false)
     */
    private $typspoAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="typspo_datechangement", type="datetime", nullable=false)
     */
    private $typspoDatechangement;

    public function getTypspoId(): ?int
    {
        return $this->typspoId;
    }

    public function getTypspoName(): ?string
    {
        return $this->typspoName;
    }

    public function setTypspoName(string $typspoName): self
    {
        $this->typspoName = $typspoName;

        return $this;
    }

    public function getTypspoDescription(): ?string
    {
        return $this->typspoDescription;
    }

    public function setTypspoDescription(?string $typspoDescription): self
    {
        $this->typspoDescription = $typspoDescription;

        return $this;
    }

    public function getTypspoAuteurcreation(): ?string
    {
        return $this->typspoAuteurcreation;
    }

    public function setTypspoAuteurcreation(string $typspoAuteurcreation): self
    {
        $this->typspoAuteurcreation = $typspoAuteurcreation;

        return $this;
    }

    public function getTypspoDatecreation(): ?\DateTimeInterface
    {
        return $this->typspoDatecreation;
    }

    public function setTypspoDatecreation(\DateTimeInterface $typspoDatecreation): self
    {
        $this->typspoDatecreation = $typspoDatecreation;

        return $this;
    }

    public function getTypspoAuteurchangement(): ?string
    {
        return $this->typspoAuteurchangement;
    }

    public function setTypspoAuteurchangement(string $typspoAuteurchangement): self
    {
        $this->typspoAuteurchangement = $typspoAuteurchangement;

        return $this;
    }

    public function getTypspoDatechangement(): ?\DateTimeInterface
    {
        return $this->typspoDatechangement;
    }

    public function setTypspoDatechangement(\DateTimeInterface $typspoDatechangement): self
    {
        $this->typspoDatechangement = $typspoDatechangement;

        return $this;
    }


}
