<?php

namespace App\Services;

use App\Repository\QuoteRepository;

class QuotesService
{
    public function __construct(private QuoteRepository $quoteRepository)
    {
    }


    /**
     * getQuotes
     *
     * @param  mixed $author
     * @param  mixed $amount
     * @return array|null
     */
    public function getQuotes(string $author, int $amount = 1): array|null
    {
        $quotes = $this->quoteRepository->findBy(['author' => $author]); // , ['author' => "RAND()"]);

        return $quotes;
    }
}
