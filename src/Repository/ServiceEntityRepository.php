<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository as ServiceEntityRepositoryExtended;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class ServiceEntityRepository extends ServiceEntityRepositoryExtended
{

    public function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    public function findById($id): object
    {

        $object = $this->findOneBy([
            'id' => $id,
            'deleted_at' => null
        ]);

        if (!$object) {
            throw new NotFoundHttpException("object with id: $id not found ");
        }

        return $object;

    }


}