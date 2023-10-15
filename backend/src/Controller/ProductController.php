<?php

namespace App\Controller;


use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ProductRepository $productRepository;
    private ProductCategoryRepository $productCategoryRepository;

    public function __construct(
        ProductRepository $productRepository,
        ProductCategoryRepository $productCategoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->productCategoryRepository = $productCategoryRepository;
    }

    #[Route('/products', name: 'app_product', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $products = $this->productRepository->findBy([
            'deleted_at' => null]);
        return $this->json($products);
    }

    #[Route('/products/{productId}', methods: ['GET'])]
    public function show(string $productId): JsonResponse
    {
        $product = $this->productRepository->findByProductId( $productId);

        return $this->json($product);
    }

    #[Route('/products', methods: ['POST'])]
    public function create(Request $request, ?ProductCategory $category): JsonResponse
    {
        //get the data from the request body
        $content = $request->getContent();
        //decode the JSON into an associative array
        $data = json_decode($content, associative: true);

        $categoryId = array_key_exists('productCategoryId', $data) ? $data['productCategoryId'] : null;

        if($categoryId){
            // if the item exists in DB and is not deleted, get the object
            $category = $this->productCategoryRepository->findById($categoryId);
        }

        $uuid = Uuid::uuid4();

        $product = new Product();

        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setPrice($data['price']);

        $product->setProductId($uuid->toString());
        $product->setProductCategory($category);


        $this->productRepository->save($product);

        return $this->json($product, status: 201);

    }

    #[Route('/products/{productId}', methods: ['PUT'])]
    public function update(string $productId, Request $request, ?ProductCategory $category): JsonResponse
    {
        $product = $this->productRepository->findByProductId($productId);

        $content = $request->getContent();
        //decode the JSON into an associative array
        $data = json_decode($content, associative: true);

        $categoryId = array_key_exists('productCategory', $data) ? $data['productCategory'] : null;

        if($categoryId){
            // if the item exists in DB and is not deleted, get the object
            $category = $this->productCategoryRepository->findById($categoryId);
        }

        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setPrice($data['price']);
        $product->setProductCategory($category);


        $this->productRepository->save($product);

        return $this->json($product);
    }

    #[Route('/products/{productId}', methods: ['DELETE'])]
    public function remove(string $productId): JsonResponse
    {
        $product = $this->productRepository->findByProductId($productId);
        $date = new DateTimeImmutable('now');

        $product->setDeletedAt($date);
        $this->productRepository->save($product);

        return $this->json([], status: 204);
    }

}
