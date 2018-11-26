<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="cat_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="categorie_cat_id_seq", allocationSize=1, initialValue=1)
     */
    private $catId;

    /**
     * @var string
     *
     * @ORM\Column(name="cat_nom", type="string", length=200, nullable=false)
     */
    private $catNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cat_description", type="string", length=200, nullable=true)
     */
    private $catDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="cat_auteurcreation", type="string", length=50, nullable=false)
     */
    private $catAuteurcreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cat_datecreation", type="datetime", nullable=false)
     */
    private $catDatecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="cat_auteurchangement", type="string", length=50, nullable=false)
     */
    private $catAuteurchangement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cat_datechangement", type="datetime", nullable=false)
     */
    private $catDatechangement;

    public function getCatId(): ?int
    {
        return $this->catId;
    }

    public function getCatNom(): ?string
    {
        return $this->catNom;
    }

    public function setCatNom(string $catNom): self
    {
        $this->catNom = $catNom;

        return $this;
    }

    public function getCatDescription(): ?string
    {
        return $this->catDescription;
    }

    public function setCatDescription(?string $catDescription): self
    {
        $this->catDescription = $catDescription;

        return $this;
    }

    public function getCatAuteurcreation(): ?string
    {
        return $this->catAuteurcreation;
    }

    public function setCatAuteurcreation(string $catAuteurcreation): self
    {
        $this->catAuteurcreation = $catAuteurcreation;

        return $this;
    }

    public function getCatDatecreation(): ?\DateTimeInterface
    {
        return $this->catDatecreation;
    }

    public function setCatDatecreation(\DateTimeInterface $catDatecreation): self
    {
        $this->catDatecreation = $catDatecreation;

        return $this;
    }

    public function getCatAuteurchangement(): ?string
    {
        return $this->catAuteurchangement;
    }

    public function setCatAuteurchangement(string $catAuteurchangement): self
    {
        $this->catAuteurchangement = $catAuteurchangement;

        return $this;
    }

    public function getCatDatechangement(): ?\DateTimeInterface
    {
        return $this->catDatechangement;
    }

    public function setCatDatechangement(\DateTimeInterface $catDatechangement): self
    {
        $this->catDatechangement = $catDatechangement;

        return $this;
    }

	public function setUpdateFields($username)
    {
        $this->setCatDatechangement(new \DateTime(date('Y-m-d H:i:s')));
        $this->setCatAuteurchangement($username);

        if($this->getCatDatecreation() == null)
        {
            $this->setCatDatecreation(new \DateTime(date('Y-m-d H:i:s')));
        }
        if($this->getCatAuteurcreation() == null)
        {
            $this->setCatAuteurcreation($username);
        }
    }
}
