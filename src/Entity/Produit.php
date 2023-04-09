<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use App\Repository\EventRepository;
#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "Id_Prod", type: "integer", nullable: false)]
    private $idProd;

 #[ORM\Column(name: "Nom_Prod", type: "string", length: 255, nullable: false)]
#[Assert\NotBlank]
private $nomProd;

#[ORM\Column(name: "Type_Prod", type: "string", length: 255, nullable: false)]
#[Assert\Type(type: "string")]
#[Assert\NotBlank]
private $typeProd;

#[ORM\Column(name: "Quantite_Prod", type: "integer", nullable: false)]
#[Assert\PositiveOrZero]
#[Assert\NotBlank]
private $quantiteProd;

#[ORM\Column(name: "PrixU_Prod", type: "float", precision: 10, scale: 0, nullable: false)]
#[Assert\PositiveOrZero]
#[Assert\NotBlank]
private $prixuProd;

#[ORM\Column(name: "Categorie_Prod", type: "string", length: 255, nullable: false)]
#[Assert\Type(type: "string")]
#[Assert\NotBlank]
private $categorieProd;

#[ORM\Column(name: "Nom_Event", type: "string", length: 255, nullable: false)]
#[Assert\NotBlank]
private $nomEvent;


    #[ORM\ManyToMany(targetEntity: Boutique::class, inversedBy: 'produits')]
    private Collection $boutiques;

   

    

    public function __construct()
    {
        $this->boutiqueProds = new ArrayCollection();
        $this->boutiques = new ArrayCollection();
    
    }

    public function getIdProd(): ?int
    {
        return $this->idProd;
    }

    public function getNomProd(): ?string
    {
        return $this->nomProd;
    }

    public function setNomProd(string $nomProd): self
    {
        $this->nomProd = $nomProd;

        return $this;
    }

    public function getTypeProd(): ?string
    {
        return $this->typeProd;
    }

    public function setTypeProd(string $typeProd): self
    {
        $this->typeProd = $typeProd;

        return $this;
    }

    public function getQuantiteProd(): ?int
    {
        return $this->quantiteProd;
    }

    public function setQuantiteProd(int $quantiteProd): self
    {
        $this->quantiteProd = $quantiteProd;

        return $this;
    }

    public function getPrixuProd(): ?float
    {
        return $this->prixuProd;
    }

    public function setPrixuProd(float $prixuProd): self
    {
        $this->prixuProd = $prixuProd;

        return $this;
    }

    public function getCategorieProd(): ?string
    {
        return $this->categorieProd;
    }

    public function setCategorieProd(string $categorieProd): self
    {
        $this->categorieProd = $categorieProd;

        return $this;
    }

    public function getNomEvent(): ?string
    {
        return $this->nomEvent;
    }

    public function setNomEvent(string $nomEvent): self
    {
        $this->nomEvent = $nomEvent;

        return $this;
    }

   

    /**
     * @return Collection<int, Boutique>
     */
    public function getBoutiques(): Collection
    {
        return $this->boutiques;
    }

    public function addBoutique(Boutique $boutique): self
    {
        if (!$this->boutiques->contains($boutique)) {
            $this->boutiques->add($boutique);
            $boutique->addIdProd($this);
        }

        return $this;
    }

    public function removeBoutique(Boutique $boutique): self
    {
        if ($this->boutiques->removeElement($boutique)) {
            $boutique->removeIdProd($this);
        }

        return $this;
    }
        public function __toString(): string
{
    return $this->nomProd;
}
}