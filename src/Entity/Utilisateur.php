<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", indexes={@ORM\Index(name="IDX_1D1C63B36620B6C4", columns={"uti_fk_iddepartement"}), @ORM\Index(name="IDX_1D1C63B38604A225", columns={"uti_fk_idniveaulisteministerielle"}), @ORM\Index(name="IDX_1D1C63B344A21B17", columns={"uti_fk_idsport"})})
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="uti_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="utilisateur_uti_id_seq", allocationSize=1, initialValue=1)
     */
    private $utiId;

    /**
     * @var string
     *
     * @ORM\Column(name="uti_nom", type="string", length=30, nullable=false)
     */
    private $utiNom;

    /**
     * @var string
     *
     * @ORM\Column(name="uti_prenom", type="string", length=30, nullable=false)
     */
    private $utiPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="uti_email", type="string", length=50, nullable=false)
     */
    private $utiEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="uti_auteurcreation", type="string", length=50, nullable=false)
     */
    private $utiAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="uti_datecreation", type="datetime", nullable=false)
     */
    private $utiDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="uti_auteurchangement", type="string", length=50, nullable=false)
     */
    private $utiAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="uti_datechangement", type="datetime", nullable=false)
     */
    private $utiDatechangement;

    /**
     * @var \Departement
     *
     * @ORM\ManyToOne(targetEntity="Departement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="uti_fk_iddepartement", referencedColumnName="dep_id")
     * })
     */
    private $utiFkdepartement;

    /**
     * @var \Niveaulisteministerielle
     *
     * @ORM\ManyToOne(targetEntity="Niveaulisteministerielle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="uti_fk_idniveaulisteministerielle", referencedColumnName="nivlismin_id")
     * })
     */
    private $utiFkniveaulisteministerielle;

    /**
     * @var \Sport
     *
     * @ORM\ManyToOne(targetEntity="Sport")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="uti_fk_idsport", referencedColumnName="spo_id")
     * })
     */
    private $utiFksport;

    public function getUtiId(): ?int
    {
        return $this->utiId;
    }

    public function getUtiNom(): ?string
    {
        return $this->utiNom;
    }

    public function setUtiNom(string $utiNom): self
    {
        $this->utiNom = $utiNom;

        return $this;
    }

    public function getUtiPrenom(): ?string
    {
        return $this->utiPrenom;
    }

    public function setUtiPrenom(string $utiPrenom): self
    {
        $this->utiPrenom = $utiPrenom;

        return $this;
    }

    public function getUtiEmail(): ?string
    {
        return $this->utiEmail;
    }

    public function setUtiEmail(string $utiEmail): self
    {
        $this->utiEmail = $utiEmail;

        return $this;
    }

    public function getUtiAuteurcreation(): ?string
    {
        return $this->utiAuteurcreation;
    }

    public function setUtiAuteurcreation(string $utiAuteurcreation): self
    {
        $this->utiAuteurcreation = $utiAuteurcreation;

        return $this;
    }

    public function getUtiDatecreation(): ?\DateTimeInterface
    {
        return $this->utiDatecreation;
    }

    public function setUtiDatecreation(\DateTimeInterface $utiDatecreation): self
    {
        $this->utiDatecreation = $utiDatecreation;

        return $this;
    }

    public function getUtiAuteurchangement(): ?string
    {
        return $this->utiAuteurchangement;
    }

    public function setUtiAuteurchangement(string $utiAuteurchangement): self
    {
        $this->utiAuteurchangement = $utiAuteurchangement;

        return $this;
    }

    public function getUtiDatechangement(): ?\DateTimeInterface
    {
        return $this->utiDatechangement;
    }

    public function setUtiDatechangement(\DateTimeInterface $utiDatechangement): self
    {
        $this->utiDatechangement = $utiDatechangement;

        return $this;
    }

    public function getUtiFkdepartement(): ?Departement
    {
        return $this->utiFkdepartement;
    }

    public function setUtiFkdepartement(?Departement $utiFkdepartement): self
    {
        $this->utiFkdepartement = $utiFkdepartement;

        return $this;
    }

    public function getUtiFkniveaulisteministerielle(): ?Niveaulisteministerielle
    {
        return $this->utiFkniveaulisteministerielle;
    }

    public function setUtiFkniveaulisteministerielle(?Niveaulisteministerielle $utiFkniveaulisteministerielle): self
    {
        $this->utiFkniveaulisteministerielle = $utiFkniveaulisteministerielle;

        return $this;
    }

    public function getUtiFksport(): ?Sport
    {
        return $this->utiFksport;
    }

    public function setUtiFksport(?Sport $utiFksport): self
    {
        $this->utiFksport = $utiFksport;

        return $this;
    }


}
