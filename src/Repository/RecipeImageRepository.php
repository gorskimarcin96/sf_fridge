<?php

namespace App\Repository;

use App\Entity\RecipeImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecipeImage>
 *
 * @method RecipeImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeImage[]    findAll()
 * @method RecipeImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipeImage::class);
    }

    public function save(RecipeImage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RecipeImage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
