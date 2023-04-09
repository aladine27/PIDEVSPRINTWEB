<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\EventRepository;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Column(name: "id_event", type: "integer", nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private int $idEvent;

    #[ORM\Column(name: "nom_event", type: "string", length: 255, nullable: false)]
    private string $nomEvent;

    #[ORM\Column(name: "type_event", type: "string", length: 255, nullable: false)]
    private string $typeEvent;

    #[ORM\Column(name: "nbre_salle", type: "integer", nullable: false)]
    private int $nbreSalle;

    #[ORM\Column(name: "date_deb", type: "date", nullable: false)]
    private \DateTimeInterface $dateDeb;

    #[ORM\Column(name: "date_fin", type: "date", nullable: false)]
    private \DateTimeInterface $dateFin;

    #[ORM\Column(name: "nbr_participants", type: "integer", nullable: false)]
    private int $nbrParticipants;
     public function getIdEvent(): ?int
    {
        return $this->idEvent;
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

    public function getTypeEvent(): ?string
    {
        return $this->typeEvent;
    }

    public function setTypeEvent(string $typeEvent): self
    {
        $this->typeEvent = $typeEvent;

        return $this;
    }

    public function getNbreSalle(): ?int
    {
        return $this->nbreSalle;
    }

    public function setNbreSalle(int $nbreSalle): self
    {
        $this->nbreSalle = $nbreSalle;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(\DateTimeInterface $dateDeb): self
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getNbrParticipants(): ?int
    {
        return $this->nbrParticipants;
    }

    public function setNbrParticipants(int $nbrParticipants): self
    {
        $this->nbrParticipants = $nbrParticipants;

        return $this;
    }

    public function __toString(): string
    {
        return $this->nomEvent;
    }

}
