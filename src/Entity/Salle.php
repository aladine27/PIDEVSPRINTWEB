<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalleRepository::class)]
class Salle
{
    #[ORM\Id]
    #[ORM\Column(length: 255)]
    private ?string $nbre_salle = null;

    #[ORM\Column(length: 255)]
    private ?string $type_stuff = null;

    #[ORM\Column(length: 255)]
    private ?string $cin_stuff = null;

   
    public function getNbreSalle(): ?string
    {
        return $this->nbre_salle;
    }

    public function setNbreSalle(string $nbre_salle): self
    {
        $this->nbre_salle = $nbre_salle;

        return $this;
    }

    public function getTypeStuff(): ?string
    {
        return $this->type_stuff;
    }

    public function setTypeStuff(string $type_stuff): self
    {
        $this->type_stuff = $type_stuff;

        return $this;
    }

    public function getCinStuff(): ?string
    {
        return $this->cin_stuff;
    }

    public function setCinStuff(string $cin_stuff): self
    {
        $this->cin_stuff = $cin_stuff;

        return $this;
    }
}
