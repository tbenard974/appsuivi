<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Absence
 *
 * @ORM\Table(name="absence", indexes={@ORM\Index(name="IDX_765AE0C97720C165", columns={"abs_fk_idfichier"}), @ORM\Index(name="IDX_765AE0C9E76E2D9E", columns={"abs_fk_idmotifabsence"}), @ORM\Index(name="IDX_765AE0C9391292D4", columns={"abs_fk_idperformance"}), @ORM\Index(name="IDX_765AE0C9F28279CA", columns={"abs_fk_idstatusabsence"}), @ORM\Index(name="IDX_765AE0C9A6D967E6", columns={"abs_fk_idutilisateur"})})
 * @ORM\Entity
 */
class Absence
{
    /**
     * @var int
     *
     * @ORM\Column(name="abs_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="absence_abs_id_seq", allocationSize=1, initialValue=1)
     */
    private $absId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="abs_datedebut", type="datetime", nullable=false)
     */
    private $absDatedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="abs_datefin", type="datetime", nullable=false)
     */
    private $absDatefin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="abs_lieu", type="string", length=50, nullable=true)
     */
    private $absLieu;

    /**
     * @var string|null
     *
     * @ORM\Column(name="abs_commentaire", type="string", length=200, nullable=true)
     */
    private $absCommentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="abs_auteurcreation", type="string", length=50, nullable=false)
     */
    private $absAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="abs_datecreation", type="datetime", nullable=false)
     */
    private $absDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="abs_auteurchangement", type="string", length=50, nullable=false)
     */
    private $absAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="abs_datechangement", type="datetime", nullable=false)
     */
    private $absDatechangement;

    /**
     * @var string
     *
     * @ORM\Column(name="abs_nom", type="string", length=200, nullable=false)
     */
    private $absNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="abs_rappel", type="string", length=50, nullable=true)
     */
    private $absRappel;

    /**
     * @var \Fichier
     *
     * @ORM\ManyToOne(targetEntity="Fichier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="abs_fk_idfichier", referencedColumnName="fic_id")
     * })
     */
    private $absFkfichier;

    /**
     * @var \Motifabsence
     *
     * @ORM\ManyToOne(targetEntity="Motifabsence")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="abs_fk_idmotifabsence", referencedColumnName="motabs_id")
     * })
     */
    private $absFkmotifabsence;

    /**
     * @var \Performance
     *
     * @ORM\ManyToOne(targetEntity="Performance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="abs_fk_idperformance", referencedColumnName="per_id")
     * })
     */
    private $absFkperformance;

    /**
     * @var \Statusabsence
     *
     * @ORM\ManyToOne(targetEntity="Statusabsence")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="abs_fk_idstatusabsence", referencedColumnName="staabs_id")
     * })
     */
    private $absFkstatusabsence;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="abs_fk_idutilisateur", referencedColumnName="uti_id")
     * })
     */
    private $absFkutilisateur;

    /**
     * @var \Typecompetition
     *
     * @ORM\ManyToOne(targetEntity="Typecompetition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="abs_fk_idtypecompetition", referencedColumnName="typcom_id")
     * })
     */
    private $absFktypecompetition;

    /**
     * @var \Echellecompetition
     *
     * @ORM\ManyToOne(targetEntity="Echellecompetition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="abs_fk_idechellecompetition", referencedColumnName="echcom_id")
     * })
     */
    private $absFkechellecompetition;

    /**
     * @var \Localisationcompetition
     *
     * @ORM\ManyToOne(targetEntity="Localisationcompetition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="abs_fk_idlocalisationcompetition", referencedColumnName="loccom_id")
     * })
     */
    private $absFklocalisationcompetition;

    public function getAbsId(): ?int
    {
        return $this->absId;
    }

    public function getAbsDatedebut(): ?\DateTimeInterface
    {
        return $this->absDatedebut;
    }

    public function setAbsDatedebut(\DateTimeInterface $absDatedebut): self
    {
        $this->absDatedebut = $absDatedebut;

        return $this;
    }

    public function getAbsDatefin(): ?\DateTimeInterface
    {
        return $this->absDatefin;
    }

    public function setAbsDatefin(\DateTimeInterface $absDatefin): self
    {
        $this->absDatefin = $absDatefin;

        return $this;
    }

    public function getAbsLieu(): ?string
    {
        return $this->absLieu;
    }

    public function setAbsLieu(?string $absLieu): self
    {
        $this->absLieu = $absLieu;

        return $this;
    }

    public function getAbsCommentaire(): ?string
    {
        return $this->absCommentaire;
    }

    public function setAbsCommentaire(?string $absCommentaire): self
    {
        $this->absCommentaire = $absCommentaire;

        return $this;
    }

    public function getAbsAuteurcreation(): ?string
    {
        return $this->absAuteurcreation;
    }

    public function setAbsAuteurcreation(string $absAuteurcreation): self
    {
        $this->absAuteurcreation = $absAuteurcreation;

        return $this;
    }

    public function getAbsDatecreation(): ?\DateTimeInterface
    {
        return $this->absDatecreation;
    }

    public function setAbsDatecreation(\DateTimeInterface $absDatecreation): self
    {
        $this->absDatecreation = $absDatecreation;

        return $this;
    }

    public function getAbsAuteurchangement(): ?string
    {
        return $this->absAuteurchangement;
    }

    public function setAbsAuteurchangement(string $absAuteurchangement): self
    {
        $this->absAuteurchangement = $absAuteurchangement;

        return $this;
    }

    public function getAbsDatechangement(): ?\DateTimeInterface
    {
        return $this->absDatechangement;
    }

    public function setAbsDatechangement(\DateTimeInterface $absDatechangement): self
    {
        $this->absDatechangement = $absDatechangement;

        return $this;
    }

    public function getAbsNom(): ?string
    {
        return $this->absNom;
    }

    public function setAbsNom(string $absNom): self
    {
        $this->absNom = $absNom;

        return $this;
    }

    public function getAbsRappel(): ?string
    {
        return $this->absRappel;
    }

    public function setAbsRappel(?string $absRappel): self
    {
        $this->absRappel = $absRappel;

        return $this;
    }

    public function getAbsFkfichier(): ?Fichier
    {
        return $this->absFkfichier;
    }

    public function setAbsFkfichier(?Fichier $absFkfichier): self
    {
        $this->absFkfichier = $absFkfichier;

        return $this;
    }

    public function getAbsFkmotifabsence(): ?Motifabsence
    {
        return $this->absFkmotifabsence;
    }

    public function setAbsFkmotifabsence(?Motifabsence $absFkmotifabsence): self
    {
        $this->absFkmotifabsence = $absFkmotifabsence;

        return $this;
    }

    public function getAbsFkperformance(): ?Performance
    {
        return $this->absFkperformance;
    }

    public function setAbsFkperformance(?Performance $absFkperformance): self
    {
        $this->absFkperformance = $absFkperformance;

        return $this;
    }

    public function getAbsFkstatusabsence(): ?Statusabsence
    {
        return $this->absFkstatusabsence;
    }

    public function setAbsFkstatusabsence(?Statusabsence $absFkstatusabsence): self
    {
        $this->absFkstatusabsence = $absFkstatusabsence;

        return $this;
    }

    public function getAbsFkutilisateur(): ?Utilisateur
    {
        return $this->absFkutilisateur;
    }

    public function setAbsFkutilisateur(?Utilisateur $absFkutilisateur): self
    {
        $this->absFkutilisateur = $absFkutilisateur;

        return $this;
    }

    public function getAbsFktypecompetition(): ?Typecompetition
    {
        return $this->absFktypecompetition;
    }

    public function setAbsFktypecompetition(?Typecompetition $absFktypecompetition): self
    {
        $this->absFktypecompetition = $absFktypecompetition;

        return $this;
    }

    public function getAbsFkechellecompetition(): ?Echellecompetition
    {
        return $this->absFkechellecompetition;
    }

    public function setAbsFkechellecompetition(?Echellecompetition $absFkechellecompetition): self
    {
        $this->absFkechellecompetition = $absFkechellecompetition;

        return $this;
    }

    public function getAbsFklocalisationcompetition(): ?Localisationcompetition
    {
        return $this->absFklocalisationcompetition;
    }

    public function setAbsFklocalisationcompetition(?Localisationcompetition $absFklocalisationcompetition): self
    {
        $this->absFklocalisationcompetition = $absFklocalisationcompetition;

        return $this;
    }
	
	public function setUpdateFields($username)
    {
        $this->setAbsDatechangement(new \DateTime(date('Y-m-d H:i:s')));
        $this->setAbsAuteurchangement($username);

        if($this->getAbsDatecreation() == null)
        {
            $this->setAbsDatecreation(new \DateTime(date('Y-m-d H:i:s')));
        }
        if($this->getAbsAuteurcreation() == null)
        {
            $this->setAbsAuteurcreation($username);
        }
    }


}
