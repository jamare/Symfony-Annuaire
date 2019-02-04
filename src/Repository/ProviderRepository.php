<?php

namespace App\Repository;

use App\Entity\Provider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Provider|null find($id, $lockMode = null, $lockVersion = null)
 * @method Provider|null findOneBy(array $criteria, array $orderBy = null)
 * @method Provider[]    findAll()
 * @method Provider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProviderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Provider::class);
    }

//    /**
//     * @return Provider[] Returns an array of Provider objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Provider
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findNLast(){
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.services','s')
            ->addSelect('s')
            ->orderBy('p.registration','DESC');
           // ->setMaxResults($n);

        return $qb->getQuery()->getResult();
    }

    public function searchServiceByNameLocalite($search_name, $search_service, $search_localite){
        $qb = $this->createQueryBuilder('s');


        if($search_name !== ''){
            $qb->andWhere('s.name LIKE :value');
            $qb->setParameter('value', '%'.$search_name.'%');
        }
        if($search_service !== ''){
            $qb->leftJoin('s.services', 'service');
            $qb->addSelect('service');
            $qb->andWhere('service.name LIKE :search_service');
            $qb->setParameter('search_service', $search_service);
        }
        if($search_localite !== ''){
            $qb->leftJoin('s.localite', 'localite');
            $qb->addSelect('localite');
            $qb->andWhere('localite.localite LIKE :search_localite');
            $qb->setParameter('search_localite', $search_localite);
        }
        $result= $qb->getQuery()->getResult();
        return $result;
    }
}
