<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_Res", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRes;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Ev", type="string", length=255, nullable=false)
     */
    private $nomEv;

    /**
     * @var int
     *
     * @ORM\Column(name="Prix_Res", type="integer", nullable=false)
     */
    private $prixRes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Res", type="date", nullable=false)
     */
    private $dateRes;

    /**
     * @var int
     *
     * @ORM\Column(name="Nbr_Place", type="integer", nullable=false)
     */
    private $nbrPlace;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_Res", type="string", length=255, nullable=false)
     */
    private $typeRes;


}
