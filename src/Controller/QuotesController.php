<?php

namespace App\Controller;

use App\Repository\QuoteRepository;
use App\Services\QuotesService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuotesController extends AbstractController
{
    public function __construct(private QuotesService $quotesService)
    {
    }

    #[Route('/quotes', name: 'app_quotes')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!'
        ]);
    }


    #[Route('/quote/{author}', name: 'app_quotes.show')]
    public function show($author): JsonResponse
    {
        $quotes = $this->quotesService->getQuotes($author);

        if(empty($quotes)) {
            return new JsonResponse(['data' => ''], 404);
        }

        return new JsonResponse([
            'data' => [
                'quote' => $quotes[0]->getQuote(),
                'author' => $quotes[0]->getAuthor()
            ]
        ]);
    }
}
