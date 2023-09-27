<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\ProductCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\Uuid;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function create(string $name, string $description, string $price, ?ProductCategory $category): Product
    {
        $uuid = Uuid::uuid4();

        $product = new Product();

        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice($price);
        $product->setProductId($uuid->toString());
        $product->setProductCategory($category);

        $this->_em->persist($product);
        $this->_em->flush();
        return $product;

    }

    public function update(Product $product, string $name, string $description, string $price): Product
    {
        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice($price);

        $this->_em->persist($product);
        $this->_em->flush();
        return $product;
    }

    public function remove(Product $product): void
    {
        $this->_em->remove($product);
        $this->_em->flush();
    }
}


