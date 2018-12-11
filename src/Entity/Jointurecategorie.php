<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Sport;

/**
 * Jointuresport
 *
 * @ORM\Table(name="jointuresport", indexes={@ORM\Index(name="IDX_333FDFF4A084C20D", columns={"joispo_fk_idcategorie"}), @ORM\Index(name="IDX_333FDFF4D81254FE", columns={"joispo_fk_idepreuve"}), @ORM\Index(name="IDX_333FDFF4499E27CB", columns={"joispo_fk_idsport"})})
 * @ORM\Entity
 */
class Jointuresport
{
    /**
     * @var int
     *
     * @ORM\Column(name="joispo_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="jointuresport_joispo_id_seq", allocationSize=1, initialValue=1)
     */
    private $joispoId;

    /**
     * @var string
     *
     * @ORM\Column(name="joispo_auteurcreation", type="string", length=50, nullable=false)
     */
    private $joispoAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="joispo_datecreation", type="datetime", nullable=false)
     */
    private $joispoDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="joispo_auteurchangement", type="string", length=50, nullable=false)
     */
    private $joispoAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="joispo_datechangement", type="datetime", nullable=false)
     */
    private $joispoDatechangement;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="joispo_fk_idcategorie", referencedColumnName="cat_id")
     * })
     */
    private $joispoFkcategorie;

    /**
     * @var \Sport
     *
     * @ORM\ManyToOne(targetEntity="Sport")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="joispo_fk_idsport", referencedColumnName="spo_id")
     * })
     */
    private $joispoFksport;

    public function getJoispoId(): ?int
    {
        return $this->joispoId;
    }

    public function getJoispoAuteurcreation(): ?string
    {
        return $this->joispoAuteurcreation;
    }

    public function setJoispoAuteurcreation(string $joispoAuteurcreation): self
    {
        $this->joispoAuteurcreation = $joispoAuteurcreation;

        return $this;
    }

    public function getJoispoDatecreation(): ?\DateTimeInterface
    {
        return $this->joispoDatecreation;
    }

    public function setJoispoDatecreation(\DateTimeInterface $joispoDatecreation): self
    {
        $this->joispoDatecreation = $joispoDatecreation;

        return $this;
    }

    public function getJoispoAuteurchangement(): ?string
    {
        return $this->joispoAuteurchangement;
    }

    public function setJoispoAuteurchangement(string $joispoAuteurchangement): self
    {
        $this->joispoAuteurchangement = $joispoAuteurchangement;

        return $this;
    }

    public function getJoispoDatechangement(): ?\DateTimeInterface
    {
        return $this->joispoDatechangement;
    }

    public function setJoispoDatechangement(\DateTimeInterface $joispoDatechangement): self
    {
        $this->joispoDatechangement = $joispoDatechangement;

        return $this;
    }

    public function getJoispoFkcategorie(): ?Epreuve
    {
        return $this->joispoFkepreuve;
    }

    public function setJoispoFkcategorie(?Epreuve $joispoFkepreuve): self
    {
        $this->joispoFkepreuve = $joispoFkepreuve;

        return $this;
    }

    public function getJoispoFksport(): ?Sport
    {
        return $this->joispoFksport;
    }

    public function setJoispoFksport(?Sport $joispoFksport): self
    {
        $this->joispoFksport = $joispoFksport;

        return $this;
    }
	
	public function setUpdateFields($username)
    {
        $this->setJoispoDatechangement(new \DateTime(date('Y-m-d H:i:s')));
        $this->setJoispoAuteurchangement($username);

        if($this->getJoispoDatecreation() == null)
        {
            $this->setJoispoDatecreation(new \DateTime(date('Y-m-d H:i:s')));
        }
        if($this->getJoispoAuteurcreation() == null)
        {
            $this->setJoispoAuteurcreation($username);
        }
    }
}
