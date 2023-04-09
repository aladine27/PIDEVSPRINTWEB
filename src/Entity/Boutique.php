<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "boutique")]
#[ORM\Entity]
class Boutique
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "id", type: "integer", nullable: false)]
    private $idBo;

  #[ORM\Column(name: "nom_Bo", type: "string", length: 255, nullable: false)]
#[Assert\NotBlank]
#[Assert\Type(type: "string")]
private $nomBo;

#[ORM\Column(name: "adresse_Bo", type: "string", length: 255, nullable: false)]
#[Assert\NotBlank]

private $adresseBo;

#[ORM\Column(name: "lat_B", type: "float", nullable: true)]
#[Assert\Type(type: "float")]
#[Assert\NotBlank]
private $latB;

#[ORM\Column(name: "long_B", type: "float", nullable: true)]
#[Assert\Type(type: "float")]
#[Assert\NotBlank]
private $longB;


    #[ORM\ManyToMany(targetEntity: Produit::class, mappedBy: 'boutiques')]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

  


    public function getIdBo(): ?int
    {
        return $this->idBo;
    }

    public function getNomBo(): ?string
    {
        return $this->nomBo;
    }

    public function setNomBo(string $nomBo): self
    {
        $this->nomBo = $nomBo;

        return $this;
    }

    public function getAdresseBo(): ?string
    {
        return $this->adresseBo;
    }

    public function setAdresseBo(string $adresseBo): self
    {
        $this->adresseBo = $adresseBo;

        return $this;
    }

    public function getLatB(): ?float
    {
        return $this->latB;
    }

    public function setLatB(?float $latB): self
    {
        $this->latB = $latB;

        return $this;
    }

    public function getLongB(): ?float
    {
        return $this->longB;
    }

    public function setLongB(?float $longB): self
    {
        $this->longB = $longB;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->addBoutique($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeBoutique($this);
        }

        return $this;
    }

    public function __toString(): string
{
    return $this->nomBo;
}

    
}