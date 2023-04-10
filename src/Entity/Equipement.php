<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipement
 *
 * @ORM\Table(name="equipement", indexes={@ORM\Index(name="id_entr", columns={"nom_entr"}), @ORM\Index(name="id_entr_2", columns={"nom_entr"})})
 * @ORM\Entity
 */
class Equipement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_equi", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEqui;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_equi", type="string", length=50, nullable=false)
     */
    private $nomEqui;

    /**
     * @var string
     *
     * @ORM\Column(name="type_eq", type="string", length=50, nullable=false)
     */
    private $typeEq;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_entr", type="string", length=50, nullable=false)
     */
    private $nomEntr;


}
