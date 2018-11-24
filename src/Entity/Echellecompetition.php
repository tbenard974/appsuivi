<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Echellecompetition
 *
 * @ORM\Table(name="echellecompetition")
 * @ORM\Entity
 */
class Echellecompetition
{
    /**
     * @var int
     *
     * @ORM\Column(name="echcom_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="echellecompetition_echcom_id_seq", allocationSize=1, initialValue=1)
     */
    private $echcomId;

    /**
     * @var string
     *
     * @ORM\Column(name="echcom_nom", type="string", length=50, nullable=false)
     */
    private $echcomNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="echcom_description", type="string", length=200, nullable=true)
     */
    private $echcomDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="echcom_auteurcreation", type="string", length=50, nullable=false)
     */
    private $echcomAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="echcom_datecreation", type="datetime", nullable=false)
     */
    private $echcomDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="echcom_auteurchangement", type="string", length=50, nullable=false)
     */
    private $echcomAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="echcom_datechangement", type="datetime", nullable=false)
     */
    private $echcomDatechangement;

    /**
     * @var string
     *
     * @ORM\Column(name="echcom_type", type="string", length=50, nullable=false)
     */
    private $echcomType;

    public function getEchcomId(): ?int
    {
        return $this->echcomId;
    }

    public function getEchcomNom(): ?string
    {
        return $this->echcomNom;
    }

    public function setEchcomNom(string $echcomNom): self
    {
        $this->echcomNom = $echcomNom;

        return $this;
    }

    public function getEchcomDescription(): ?string
    {
        return $this->echcomDescription;
    }

    public function setEchcomDescription(?string $echcomDescription): self
    {
        $this->echcomDescription = $echcomDescription;

        return $this;
    }

    public function getEchcomAuteurcreation(): ?string
    {
        return $this->echcomAuteurcreation;
    }

    public function setEchcomAuteurcreation(string $echcomAuteurcreation): self
    {
        $this->echcomAuteurcreation = $echcomAuteurcreation;

        return $this;
    }

    public function getEchcomDatecreation(): ?\DateTimeInterface
    {
        return $this->echcomDatecreation;
    }

    public function setEchcomDatecreation(\DateTimeInterface $echcomDatecreation): self
    {
        $this->echcomDatecreation = $echcomDatecreation;

        return $this;
    }

    public function getEchcomAuteurchangement(): ?string
    {
        return $this->echcomAuteurchangement;
    }

    public function setEchcomAuteurchangement(string $echcomAuteurchangement): self
    {
        $this->echcomAuteurchangement = $echcomAuteurchangement;

        return $this;
    }

    public function getEchcomDatechangement(): ?\DateTimeInterface
    {
        return $this->echcomDatechangement;
    }

    public function setEchcomDatechangement(\DateTimeInterface $echcomDatechangement): self
    {
        $this->echcomDatechangement = $echcomDatechangement;

        return $this;
    }

    public function getEchcomType(): ?string
    {
        return $this->echcomType;
    }

    public function setEchcomType(string $echcomType): self
    {
        $this->echcomType = $echcomType;

        return $this;
    }

    public function setUpdateFields($username)
    {
        $this->setEchcomDatechangement(new \DateTime(date('Y-m-d H:i:s')));
        $this->setEchcomAuteurchangement($username);

        if($this->getEchcomDatecreation() == null)
        {
            $this->setEchcomDatecreation(new \DateTime(date('Y-m-d H:i:s')));
        }
        if($this->getEchcomAuteurcreation() == null)
        {
            $this->setEchcomAuteurcreation($username);
        }
    }


}
