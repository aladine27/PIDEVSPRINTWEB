<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entreprise
 *
 * @ORM\Table(name="entreprise")
 * @ORM\Entity
 */
class Entreprise
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_entr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEntr;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_entr", type="string", length=50, nullable=false)
     */
    private $nomEntr;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_entr", type="string", length=50, nullable=false)
     */
    private $adresseEntr;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_entr", type="string", length=50, nullable=false)
     */
    private $mailEntr;


}
