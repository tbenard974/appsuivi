<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity
 */
class Role
{
    /**
     * @var int
     *
     * @ORM\Column(name="rol_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="role_rol_id_seq", allocationSize=1, initialValue=1)
     */
    private $rolId;

    /**
     * @var string
     *
     * @ORM\Column(name="rol_nom", type="string", length=30, nullable=false)
     */
    private $rolNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rol_description", type="string", length=50, nullable=true)
     */
    private $rolDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="rol_auteurcreation", type="string", length=50, nullable=false)
     */
    private $rolAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="rol_datecreation", type="datetime", nullable=false)
     */
    private $rolDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="rol_auteurchangement", type="string", length=50, nullable=false)
     */
    private $rolAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="rol_datechangement", type="datetime", nullable=false)
     */
    private $rolDatechangement;

    public function getRolId(): ?int
    {
        return $this->rolId;
    }

    public function getRolNom(): ?string
    {
        return $this->rolNom;
    }

    public function setRolNom(string $rolNom): self
    {
        $this->rolNom = $rolNom;

        return $this;
    }

    public function getRolDescription(): ?string
    {
        return $this->rolDescription;
    }

    public function setRolDescription(?string $rolDescription): self
    {
        $this->rolDescription = $rolDescription;

        return $this;
    }

    public function getRolAuteurcreation(): ?string
    {
        return $this->rolAuteurcreation;
    }

    public function setRolAuteurcreation(string $rolAuteurcreation): self
    {
        $this->rolAuteurcreation = $rolAuteurcreation;

        return $this;
    }

    public function getRolDatecreation(): ?\DateTimeInterface
    {
        return $this->rolDatecreation;
    }

    public function setRolDatecreation(\DateTimeInterface $rolDatecreation): self
    {
        $this->rolDatecreation = $rolDatecreation;

        return $this;
    }

    public function getRolAuteurchangement(): ?string
    {
        return $this->rolAuteurchangement;
    }

    public function setRolAuteurchangement(string $rolAuteurchangement): self
    {
        $this->rolAuteurchangement = $rolAuteurchangement;

        return $this;
    }

    public function getRolDatechangement(): ?\DateTimeInterface
    {
        return $this->rolDatechangement;
    }

    public function setRolDatechangement(\DateTimeInterface $rolDatechangement): self
    {
        $this->rolDatechangement = $rolDatechangement;

        return $this;
    }


}
