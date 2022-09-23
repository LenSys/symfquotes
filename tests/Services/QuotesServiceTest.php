<?php

namespace App\Tests\Services;

use App\DataFixtures\QuoteFixtures;
use App\Entity\Quote;
use App\Services\QuotesService;
use App\Tests\DatabaseDependantTestCase;

class QuotesServiceTest extends DatabaseDependantTestCase
{

    private QuotesService $quotesService;

    public function setUp(): void
    {
        parent::setUp();

        $this->quotesService = self::$kernel->getContainer()->get('app-quotes-service');
    }

    
    /*
    public function testGetQuotes(): void
    {   
        $quote = new Quote();
        $quote->setAuthor("albi");
        $quote->setQuote("quote");
        $this->entityManager->persist($quote);
        $this->entityManager->flush();

        // $quotes = $this->quotesService->getQuotes("Albert Einstein");

        // dd($quotes);
        $this->assertCount(1, $quotes);
    }
    */

    public function testGetSingleQuoteFromEntity(): void
    {
        $quote = new Quote();
        $quote->setAuthor("albi");
        $quote->setQuote("quote");

        $this->entityManager->persist($quote);
        $this->entityManager->flush();

        $quotes = $this->quotesService->getQuotes("Oscar Wilde");
        
        $quotesAlbi = $this->quotesService->getQuotes("albi");

        $this->assertCount(1, $quotes);
        $this->assertSame("Be yourself; everyone else is already taken.", $quotes[0]->getQuote());

        $this->assertCount(1, $quotesAlbi);
        $this->assertSame("quote", $quotesAlbi[0]->getQuote());
    }
    
}