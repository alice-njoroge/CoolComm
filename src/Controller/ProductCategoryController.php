<?php

namespace App\Controller;

use App\Entity\ProductCategory;
use App\Repository\ProductCategoryRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductCategoryController extends AbstractController
{
    private ProductCategoryRepository $productCategoryRepository;
    private ValidatorInterface $validator;

    public function __construct(ProductCategoryRepository $productCategoryRepository, ValidatorInterface $validator)
    {
        $this->productCategoryRepository = $productCategoryRepository;
        $this->validator = $validator;
    }

    #[Route('/products/categories', name: 'app_product_category', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $category = $this->productCategoryRepository->findBy([
            'deleted_at' => null
        ]);
        return $this->json($category);
    }

    #[Route('/products/categories/{categoryId}', methods: ['GET'])]
    public function show(string $categoryId): JsonResponse
    {
        $category = $this->productCategoryRepository->findById($categoryId);
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

        $errors = $this->validator->validate($category);
        if (count($errors) > 0){
            $errorString = (string) $errors;
            return $this->json($errorString, status: 400);
        }



        $this->productCategoryRepository->save($category);

        return $this->json([], status: 201);

    }

    #[Route('/products/categories/{categoryId}', methods: ['POST'])]
    public function update(Request $request, string $categoryId): JsonResponse
    {
        $category = $this->productCategoryRepository->findById($categoryId);

        //:TODO is it possible to decode this JSON more efficiently?
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

        $category = $this->productCategoryRepository->findById($categoryId);

        $date = new DateTimeImmutable('now');
        $category->setDeletedAt($date);

        $this->productCategoryRepository->save($category);

        return $this->json(['message'=> "item with id: $categoryId has been deleted successfully"], status: 204);
    }

}
