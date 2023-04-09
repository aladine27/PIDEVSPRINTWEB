<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'produitboutique')]
#[ORM\Entity]
class Produitboutique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'id')]
    private $id;

   #[ORM\ManyToOne(targetEntity: Boutique::class)]
#[ORM\JoinColumn(name: 'id_boutique', referencedColumnName: 'id', unique:false)]
    private $idBoutique;

    #[ORM\ManyToOne(targetEntity: Produit::class)]
    #[ORM\JoinColumn(name: 'id_produit', referencedColumnName: 'Id_Prod')]
    private $idProduit;

    #[ORM\Column(length: 255)]
    private $image = null;

    #[ORM\Column]
    private $quantite = null;

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdBoutique(): ?Boutique
    {
        return $this->idBoutique;
    }

    public function setIdBoutique($idBoutique): self
    {
        $this->idBoutique = $idBoutique;

        return $this;
    }

    public function getIdProduit(): ?Produit
    {
        return $this->idProduit;
    }

    public function setIdProduit($idProduit): self
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        // On récupère la quantité en stock du produit
        $quantiteStock = $this->getIdProduit()->getQuantiteProd();
        
        // Si la quantité saisie est supérieure à la quantité en stock, on lance une exception
        if ($quantite > $quantiteStock) {
            throw new \InvalidArgumentException(sprintf('La quantité saisie (%d) est supérieure à la quantité en stock (%d)', $quantite, $quantiteStock));
        }
        
        // On met à jour la quantité en stock du produit
        $this->getIdProduit()->setQuantiteProd($quantiteStock - $quantite);
        
        $this->quantite = $quantite;

        return $this;
    }



}