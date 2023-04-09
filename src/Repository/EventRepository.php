<?php

// src/Repository/EventRepository.php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;
/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }
    
    public function findAllNames()
    {
        $qb = $this->createQueryBuilder('e')
            ->select('e.nomEvent')
            ->orderBy('e.nomEvent', 'ASC')
            ->getQuery();

        $result = $qb->getResult();
        
        return array_column($result, 'nomEvent');
    }
}