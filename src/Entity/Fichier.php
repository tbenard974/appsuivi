<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fichier
 *
 * @ORM\Table(name="fichier", indexes={@ORM\Index(name="IDX_9B76551F9F47BC56", columns={"fic_fk_idtypefichier"}), @ORM\Index(name="IDX_9B76551FC3C90641", columns={"fic_fk_idutilisateur"})})
 * @ORM\Entity
 */
class Fichier
{
    /**
     * @var int
     *
     * @ORM\Column(name="fic_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="fichier_fic_id_seq", allocationSize=1, initialValue=1)
     */
    private $ficId;

    /**
     * @var string
     *
     * @ORM\Column(name="fic_chemin", type="string", length=200, nullable=false)
     */
    private $ficChemin;

    /**
     * @var string
     *
     * @ORM\Column(name="fic_auteurcreation", type="string", length=50, nullable=false)
     */
    private $ficAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fic_datecreation", type="datetime", nullable=false)
     */
    private $ficDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="fic_auteurchangement", type="string", length=50, nullable=false)
     */
    private $ficAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fic_datechangement", type="datetime", nullable=false)
     */
    private $ficDatechangement;

    /**
     * @var \Typefichier
     *
     * @ORM\ManyToOne(targetEntity="Typefichier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fic_fk_idtypefichier", referencedColumnName="typfic_id")
     * })
     */
    private $ficFktypefichier;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fic_fk_idutilisateur", referencedColumnName="uti_id")
     * })
     */
    private $ficFkutilisateur;

    /**
     * @var \Performance
     *
     * @ORM\ManyToOne(targetEntity="Performance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fic_fk_idperformance", referencedColumnName="per_id")
     * })
     */
    private $ficFkperformance;

    public function getFicId(): ?int
    {
        return $this->ficId;
    }

    public function getFicChemin(): ?string
    {
        return $this->ficChemin;
    }

    public function setFicChemin(string $ficChemin): self
    {
        $this->ficChemin = $ficChemin;

        return $this;
    }

    public function getFicAuteurcreation(): ?string
    {
        return $this->ficAuteurcreation;
    }

    public function setFicAuteurcreation(string $ficAuteurcreation): self
    {
        $this->ficAuteurcreation = $ficAuteurcreation;

        return $this;
    }

    public function getFicDatecreation(): ?\DateTimeInterface
    {
        return $this->ficDatecreation;
    }

    public function setFicDatecreation(\DateTimeInterface $ficDatecreation): self
    {
        $this->ficDatecreation = $ficDatecreation;

        return $this;
    }

    public function getFicAuteurchangement(): ?string
    {
        return $this->ficAuteurchangement;
    }

    public function setFicAuteurchangement(string $ficAuteurchangement): self
    {
        $this->ficAuteurchangement = $ficAuteurchangement;

        return $this;
    }

    public function getFicDatechangement(): ?\DateTimeInterface
    {
        return $this->ficDatechangement;
    }

    public function setFicDatechangement(\DateTimeInterface $ficDatechangement): self
    {
        $this->ficDatechangement = $ficDatechangement;

        return $this;
    }

    public function getFicFktypefichier(): ?Typefichier
    {
        return $this->ficFktypefichier;
    }

    public function setFicFktypefichier(?Typefichier $ficFktypefichier): self
    {
        $this->ficFktypefichier = $ficFktypefichier;

        return $this;
    }

    public function getFicFkutilisateur(): ?Utilisateur
    {
        return $this->ficFkutilisateur;
    }

    public function setFicFkutilisateur(?Utilisateur $ficFkutilisateur): self
    {
        $this->ficFkutilisateur = $ficFkutilisateur;

        return $this;
    }

    public function getFicFkperformance(): ?Performance
    {
        return $this->ficFkperformance;
    }

    public function setFicFkperformance(?Performance $ficFkperformance): self
    {
        $this->ficFkperformance = $ficFkperformance;

        return $this;
    }

	public function setUpdateFields($username)
    {
        $this->setFicDatechangement(new \DateTime(date('Y-m-d H:i:s')));
        $this->setFicAuteurchangement($username);

        if($this->getFicDatecreation() == null)
        {
            $this->setFicDatecreation(new \DateTime(date('Y-m-d H:i:s')));
        }
        if($this->getFicAuteurcreation() == null)
        {
            $this->setFicAuteurcreation($username);
        }
    }

}
