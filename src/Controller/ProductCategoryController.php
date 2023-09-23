<?php

namespace App\Controller;

use App\Entity\ProductCategory;
use App\Repository\ProductCategoryRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductCategoryController extends AbstractController
{
    private ProductCategoryRepository $productCategoryRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
    }

    #[Route('/products/categories', name: 'app_product_category', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $products = $this->productCategoryRepository->findBy([
            'deleted_at' => null
        ]);
        return $this->json($products);
    }

    #[Route('/products/categories/{categoryId}', methods: ['GET'])]
    public function show(string $categoryId): JsonResponse
    {
        $category = $this->productCategoryRepository->findOneBy([
            'id' => $categoryId,
            'deleted_at' => null

        ]);

        if (!$category) {
            return $this->json(["error" => "product with id: $categoryId not found "], status: 404);
        }
        return $this->json($category);
    }

    #[Route('/products/categories', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $content = $request->getContent();
        $data = json_decode($content, associative: true);

        $date = new DateTimeImmutable('now');

        $category = new ProductCategory();

        $category->setName($data['name']);
        $category->setDescription($data['description']);
        $category->setCreatedAt($date);

        $this->productCategoryRepository->save($category);

        return $this->json([], status: 201);

    }

    #[Route('/products/categories/{categoryId}', methods: ['POST'])]
    public function update(Request $request, string $categoryId): JsonResponse
    {
        //get the product category by id - if not found, return an error - otherwise persist the changes
        $category = $this->productCategoryRepository->findOneBy([
            'id' => $categoryId,
            'deleted_at' => null
        ]);

        if (!$category) {
            return $this->json(['error' => "product category with id: $categoryId not found "], status: 404);
        }

        $content = $request->getContent();
        $data = json_decode($content, associative: true);
        $date = new DateTimeImmutable('now');

        $category->setName($data['name']);
        $category->setDescription($data['description']);

        $category->setModifiedAt($date);

        $category = $this->productCategoryRepository->save($category);

        return $this->json($category);
    }

    #[Route('/products/categories/{categoryId}', methods: ['DELETE'])]
    public function remove($categoryId): JsonResponse
    {

        $category = $this->productCategoryRepository->findOneBy([
            'id' => $categoryId,
            'deleted_at' => null
        ]);
        if (!$category) {
            return $this->json(['error' => "category with id $categoryId does not exist"]);
        }
        $date = new DateTimeImmutable('now');
        $category->setDeletedAt($date);

        $this->productCategoryRepository->save($category);

        return $this->json([], status: 204);
    }

}
