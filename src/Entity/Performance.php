<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Performance
 *
 * @ORM\Table(name="performance", indexes={@ORM\Index(name="IDX_82D796816FE9093E", columns={"per_fk_idechellecompetition"}), @ORM\Index(name="IDX_82D7968141C19AA6", columns={"per_fk_idjointuresport"}), @ORM\Index(name="IDX_82D79681ADCBBD4A", columns={"per_fk_idlocalisationcompetition"}), @ORM\Index(name="IDX_82D796818312E2F7", columns={"per_fk_idresultat"}), @ORM\Index(name="IDX_82D796814579F2DB", columns={"per_fk_idtypecompetition"}), @ORM\Index(name="IDX_82D796818614CA2F", columns={"per_fk_idutilisateur"})})
 * @ORM\Entity
 */
class Performance
{
    /**
     * @var int
     *
     * @ORM\Column(name="per_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="performance_per_id_seq", allocationSize=1, initialValue=1)
     */
    private $perId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="per_datedebut", type="datetime", nullable=false)
     */
    private $perDatedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="per_datefin", type="datetime", nullable=false)
     */
    private $perDatefin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="per_lieu", type="string", length=200, nullable=true)
     */
    private $perLieu;

    /**
     * @var bool
     *
     * @ORM\Column(name="per_importance", type="boolean", nullable=false)
     */
    private $perImportance;

    /**
     * @var string|null
     *
     * @ORM\Column(name="per_ressenti", type="string", length=200, nullable=true)
     */
    private $perRessenti;

    /**
     * @var string
     *
     * @ORM\Column(name="per_auteurcreation", type="string", length=50, nullable=false)
     */
    private $perAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="per_datecreation", type="datetime", nullable=false)
     */
    private $perDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="per_auteurchangement", type="string", length=50, nullable=false)
     */
    private $perAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="per_datechangement", type="datetime", nullable=false)
     */
    private $perDatechangement;

    /**
     * @var \Echellecompetition
     *
     * @ORM\ManyToOne(targetEntity="Echellecompetition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="per_fk_idechellecompetition", referencedColumnName="echcom_id")
     * })
     */
    private $perFkechellecompetition;

    /**
     * @var \Jointuresport
     *
     * @ORM\ManyToOne(targetEntity="Jointuresport")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="per_fk_idjointuresport", referencedColumnName="joispo_id")
     * })
     */
    private $perFkjointuresport;

    /**
     * @var \Localisationcompetition
     *
     * @ORM\ManyToOne(targetEntity="Localisationcompetition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="per_fk_idlocalisationcompetition", referencedColumnName="loccom_id")
     * })
     */
    private $perFklocalisationcompetition;

    /**
     * @var \Resultat
     *
     * @ORM\ManyToOne(targetEntity="Resultat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="per_fk_idresultat", referencedColumnName="res_id")
     * })
     */
    private $perFkresultat;

    /**
     * @var \Typecompetition
     *
     * @ORM\ManyToOne(targetEntity="Typecompetition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="per_fk_idtypecompetition", referencedColumnName="typcom_id")
     * })
     */
    private $perFktypecompetition;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="per_fk_idutilisateur", referencedColumnName="uti_id")
     * })
     */
    private $perFkutilisateur;

    public function getPerId(): ?int
    {
        return $this->perId;
    }

    public function getPerDatedebut(): ?\DateTimeInterface
    {
        return $this->perDatedebut;
    }

    public function setPerDatedebut(\DateTimeInterface $perDatedebut): self
    {
        $this->perDatedebut = $perDatedebut;

        return $this;
    }

    public function getPerDatefin(): ?\DateTimeInterface
    {
        return $this->perDatefin;
    }

    public function setPerDatefin(\DateTimeInterface $perDatefin): self
    {
        $this->perDatefin = $perDatefin;

        return $this;
    }

    public function getPerLieu(): ?string
    {
        return $this->perLieu;
    }

    public function setPerLieu(?string $perLieu): self
    {
        $this->perLieu = $perLieu;

        return $this;
    }

    public function getPerImportance(): ?bool
    {
        return $this->perImportance;
    }

    public function setPerImportance(bool $perImportance): self
    {
        $this->perImportance = $perImportance;

        return $this;
    }

    public function getPerRessenti(): ?string
    {
        return $this->perRessenti;
    }

    public function setPerRessenti(?string $perRessenti): self
    {
        $this->perRessenti = $perRessenti;

        return $this;
    }

    public function getPerAuteurcreation(): ?string
    {
        return $this->perAuteurcreation;
    }

    public function setPerAuteurcreation(string $perAuteurcreation): self
    {
        $this->perAuteurcreation = $perAuteurcreation;

        return $this;
    }

    public function getPerDatecreation(): ?\DateTimeInterface
    {
        return $this->perDatecreation;
    }

    public function setPerDatecreation(\DateTimeInterface $perDatecreation): self
    {
        $this->perDatecreation = $perDatecreation;

        return $this;
    }

    public function getPerAuteurchangement(): ?string
    {
        return $this->perAuteurchangement;
    }

    public function setPerAuteurchangement(string $perAuteurchangement): self
    {
        $this->perAuteurchangement = $perAuteurchangement;

        return $this;
    }

    public function getPerDatechangement(): ?\DateTimeInterface
    {
        return $this->perDatechangement;
    }

    public function setPerDatechangement(\DateTimeInterface $perDatechangement): self
    {
        $this->perDatechangement = $perDatechangement;

        return $this;
    }

    public function getPerFkechellecompetition(): ?Echellecompetition
    {
        return $this->perFkechellecompetition;
    }

    public function setPerFkechellecompetition(?Echellecompetition $perFkechellecompetition): self
    {
        $this->perFkechellecompetition = $perFkechellecompetition;

        return $this;
    }

    public function getPerFkjointuresport(): ?Jointuresport
    {
        return $this->perFkjointuresport;
    }

    public function setPerFkjointuresport(?Jointuresport $perFkjointuresport): self
    {
        $this->perFkjointuresport = $perFkjointuresport;

        return $this;
    }

    public function getPerFklocalisationcompetition(): ?Localisationcompetition
    {
        return $this->perFklocalisationcompetition;
    }

    public function setPerFklocalisationcompetition(?Localisationcompetition $perFklocalisationcompetition): self
    {
        $this->perFklocalisationcompetition = $perFklocalisationcompetition;

        return $this;
    }

    public function getPerFkresultat(): ?Resultat
    {
        return $this->perFkresultat;
    }

    public function setPerFkresultat(?Resultat $perFkresultat): self
    {
        $this->perFkresultat = $perFkresultat;

        return $this;
    }

    public function getPerFktypecompetition(): ?Typecompetition
    {
        return $this->perFktypecompetition;
    }

    public function setPerFktypecompetition(?Typecompetition $perFktypecompetition): self
    {
        $this->perFktypecompetition = $perFktypecompetition;

        return $this;
    }

    public function getPerFkutilisateur(): ?Utilisateur
    {
        return $this->perFkutilisateur;
    }

    public function setPerFkutilisateur(?Utilisateur $perFkutilisateur): self
    {
        $this->perFkutilisateur = $perFkutilisateur;

        return $this;
    }

	public function setUpdateFields($username)
    {
        $this->setPerDatechangement(new \DateTime(date('Y-m-d H:i:s')));
        $this->setPerAuteurchangement($username);

        if($this->getPerDatecreation() == null)
        {
            $this->setPerDatecreation(new \DateTime(date('Y-m-d H:i:s')));
        }
        if($this->getPerAuteurcreation() == null)
        {
            $this->setPerAuteurcreation($username);
        }
    }
}
