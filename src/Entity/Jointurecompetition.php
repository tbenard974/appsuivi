<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jointurecompetition
 *
 * @ORM\Table(name="jointurecompetition", indexes={@ORM\Index(name="IDX_808DA18DD85411DE", columns={"joicom_fk_idcategorie"}), @ORM\Index(name="IDX_808DA18D149BF1ED", columns={"joicom_fk_idcompetition"}), @ORM\Index(name="IDX_808DA18D5DBC3A5A", columns={"joicom_fk_iddivision"}), @ORM\Index(name="IDX_808DA18DDD53C254", columns={"joicom_fk_idjointuresport"})})
 * @ORM\Entity
 */
class Jointurecompetition
{
    /**
     * @var int
     *
     * @ORM\Column(name="joicom_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="jointurecompetition_joicom_id_seq", allocationSize=1, initialValue=1)
     */
    private $joicomId;

    /**
     * @var string
     *
     * @ORM\Column(name="joicom_auteurcreation", type="string", length=50, nullable=false)
     */
    private $joicomAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="joicom_datecreation", type="datetime", nullable=false)
     */
    private $joicomDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="joicom_auteurchangement", type="string", length=50, nullable=false)
     */
    private $joicomAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="joicom_datechangement", type="datetime", nullable=false)
     */
    private $joicomDatechangement;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="joicom_fk_idcategorie", referencedColumnName="cat_id")
     * })
     */
    private $joicomFkcategorie;

    /**
     * @var \Competition
     *
     * @ORM\ManyToOne(targetEntity="Competition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="joicom_fk_idcompetition", referencedColumnName="com_id")
     * })
     */
    private $joicomFkcompetition;

    /**
     * @var \Division
     *
     * @ORM\ManyToOne(targetEntity="Division")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="joicom_fk_iddivision", referencedColumnName="div_id")
     * })
     */
    private $joicomFkdivision;

    /**
     * @var \Jointuresport
     *
     * @ORM\ManyToOne(targetEntity="Jointuresport")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="joicom_fk_idjointuresport", referencedColumnName="joispo_id")
     * })
     */
    private $joicomFkjointuresport;

    public function getJoicomId(): ?int
    {
        return $this->joicomId;
    }

    public function getJoicomAuteurcreation(): ?string
    {
        return $this->joicomAuteurcreation;
    }

    public function setJoicomAuteurcreation(string $joicomAuteurcreation): self
    {
        $this->joicomAuteurcreation = $joicomAuteurcreation;

        return $this;
    }

    public function getJoicomDatecreation(): ?\DateTimeInterface
    {
        return $this->joicomDatecreation;
    }

    public function setJoicomDatecreation(\DateTimeInterface $joicomDatecreation): self
    {
        $this->joicomDatecreation = $joicomDatecreation;

        return $this;
    }

    public function getJoicomAuteurchangement(): ?string
    {
        return $this->joicomAuteurchangement;
    }

    public function setJoicomAuteurchangement(string $joicomAuteurchangement): self
    {
        $this->joicomAuteurchangement = $joicomAuteurchangement;

        return $this;
    }

    public function getJoicomDatechangement(): ?\DateTimeInterface
    {
        return $this->joicomDatechangement;
    }

    public function setJoicomDatechangement(\DateTimeInterface $joicomDatechangement): self
    {
        $this->joicomDatechangement = $joicomDatechangement;

        return $this;
    }

    public function getJoicomFkcategorie(): ?Categorie
    {
        return $this->joicomFkcategorie;
    }

    public function setJoicomFkcategorie(?Categorie $joicomFkcategorie): self
    {
        $this->joicomFkcategorie = $joicomFkcategorie;

        return $this;
    }

    public function getJoicomFkcompetition(): ?Competition
    {
        return $this->joicomFkcompetition;
    }

    public function setJoicomFkcompetition(?Competition $joicomFkcompetition): self
    {
        $this->joicomFkcompetition = $joicomFkcompetition;

        return $this;
    }

    public function getJoicomFkdivision(): ?Division
    {
        return $this->joicomFkdivision;
    }

    public function setJoicomFkdivision(?Division $joicomFkdivision): self
    {
        $this->joicomFkdivision = $joicomFkdivision;

        return $this;
    }

    public function getJoicomFkjointuresport(): ?Jointuresport
    {
        return $this->joicomFkjointuresport;
    }

    public function setJoicomFkjointuresport(?Jointuresport $joicomFkjointuresport): self
    {
        $this->joicomFkjointuresport = $joicomFkjointuresport;

        return $this;
    }


}
