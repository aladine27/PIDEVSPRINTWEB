<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture")
 * @ORM\Entity
 */
class Facture
{
    
    /**
     * @var string
     *
     * #[ORM\Column(name: "Mail", type: "string", length: 255, nullable: false)]
     */
    private string $mail;

    /**
     * @var string
     *
     * #[ORM\Column(name: "Nom_Achat", type: "string", length: 255, nullable: false)]
     */
    private string $nomAchat;

    /**
     * @var int
     *
     * #[ORM\Column(name: "Ref_Achete", type: "integer", nullable: false)]
     */
    private int $refAchete;

    /**
     * @var float
     *
     * #[ORM\Column(name: "PrixU_Achat", type: "float", precision: 10, scale: 0, nullable: false)]
     */
    private float $prixuAchat;
}
