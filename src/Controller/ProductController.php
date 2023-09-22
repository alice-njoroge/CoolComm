<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ProductRepository $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    #[Route('/products', name: 'app_product', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProductController.php',
        ]);
    }

    #[Route('/products', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        //get the data from the request body
        $content = $request->getContent();
        //decode the JSON into an associative array
        $data = json_decode($content, associative: true);

        $name = $data['name'];
        $description = $data['description'];
        $price = $data['price'];

        $this->productRepository->create($name, $description, $price);

       return $this->json([], status:201 );

    }
}
