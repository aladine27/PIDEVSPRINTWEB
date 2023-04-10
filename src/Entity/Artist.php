<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_Ar = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom_Ar = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_NesAr = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $detail_ar = null;

    #[ORM\Column(length: 255)]
    private ?string $genre_Ar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAr(): ?string
    {
        return $this->nom_Ar;
    }

    public function setNomAr(string $nom_Ar): self
    {
        $this->nom_Ar = $nom_Ar;

        return $this;
    }

    public function getPrenomAr(): ?string
    {
        return $this->prenom_Ar;
    }

    public function setPrenomAr(string $prenom_Ar): self
    {
        $this->prenom_Ar = $prenom_Ar;

        return $this;
    }

    public function getDateNesAr(): ?\DateTimeInterface
    {
        return $this->date_NesAr;
    }

    public function setDateNesAr(\DateTimeInterface $date_NesAr): self
    {
        $this->date_NesAr = $date_NesAr;

        return $this;
    }

    public function getDetailAr(): ?string
    {
        return $this->detail_ar;
    }

    public function setDetailAr(string $detail_ar): self
    {
        $this->detail_ar = $detail_ar;

        return $this;
    }

    public function getGenreAr(): ?string
    {
        return $this->genre_Ar;
    }

    public function setGenreAr(string $genre_Ar): self
    {
        $this->genre_Ar = $genre_Ar;

        return $this;
    }
}
