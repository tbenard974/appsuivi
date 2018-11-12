<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competition
 *
 * @ORM\Table(name="competition")
 * @ORM\Entity
 */
class Competition
{
    /**
     * @var int
     *
     * @ORM\Column(name="com_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="competition_com_id_seq", allocationSize=1, initialValue=1)
     */
    private $comId;

    /**
     * @var string
     *
     * @ORM\Column(name="com_name", type="string", length=50, nullable=false)
     */
    private $comName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="com_description", type="string", length=200, nullable=true)
     */
    private $comDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="com_auteurcreation", type="string", length=50, nullable=false)
     */
    private $comAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="com_datecreation", type="datetime", nullable=false)
     */
    private $comDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="com_auteurchangement", type="string", length=50, nullable=false)
     */
    private $comAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="com_datechangement", type="datetime", nullable=false)
     */
    private $comDatechangement;

    public function getComId(): ?int
    {
        return $this->comId;
    }

    public function getComName(): ?string
    {
        return $this->comName;
    }

    public function setComName(string $comName): self
    {
        $this->comName = $comName;

        return $this;
    }

    public function getComDescription(): ?string
    {
        return $this->comDescription;
    }

    public function setComDescription(?string $comDescription): self
    {
        $this->comDescription = $comDescription;

        return $this;
    }

    public function getComAuteurcreation(): ?string
    {
        return $this->comAuteurcreation;
    }

    public function setComAuteurcreation(string $comAuteurcreation): self
    {
        $this->comAuteurcreation = $comAuteurcreation;

        return $this;
    }

    public function getComDatecreation(): ?\DateTimeInterface
    {
        return $this->comDatecreation;
    }

    public function setComDatecreation(\DateTimeInterface $comDatecreation): self
    {
        $this->comDatecreation = $comDatecreation;

        return $this;
    }

    public function getComAuteurchangement(): ?string
    {
        return $this->comAuteurchangement;
    }

    public function setComAuteurchangement(string $comAuteurchangement): self
    {
        $this->comAuteurchangement = $comAuteurchangement;

        return $this;
    }

    public function getComDatechangement(): ?\DateTimeInterface
    {
        return $this->comDatechangement;
    }

    public function setComDatechangement(\DateTimeInterface $comDatechangement): self
    {
        $this->comDatechangement = $comDatechangement;

        return $this;
    }


}
