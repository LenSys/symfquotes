<?php

namespace App\Tests\Entity;

use App\Entity\Quote;
use App\Tests\DatabaseDependantTestCase;

class QuoteTest extends DatabaseDependantTestCase
{
    public function testInitUnitTest(): void
    {
        $this->assertTrue(true);
    }


    public function testEnsureTestEnvironment()
    {
        $this->assertSame('test', self::$kernel->getEnvironment());
    }


    public function testGetSingleQuoteFromEntity(): void
    {
        $quote = new Quote();
        $quote->setQuote("Be yourself; everyone else is already taken.");
        $quote->setAuthor("Oscar Wilde");

        $this->entityManager->persist($quote);
        $this->entityManager->flush();

        $quoteRepository = $this->entityManager->getRepository(Quote::class);
        $quoteEntry = $quoteRepository->findOneBy(['author' => 'Oscar Wilde']);

        $this->assertSame('Be yourself; everyone else is already taken.', $quoteEntry->getQuote());
    }


    public function testGetMultipleQuotesFromEntity(): void
    {
        // use data not yet present in quote fixture
        $quotesList = [
            [
                "quote" => "If you can't explain it to a six year old, you don't understand it yourself.",
                "author" => "Albert Einstein"
            ],
            [
                "quote" => "Be yourself; everyone else is already taken.",
                "author" => "Oscar Wilde"
            ],
            [
                "quote" => "Logic will get you from A to Z; imagination will get you everywhere.",
                "author" => "Albert Einstein"
            ],
            [
                "quote" => "Knowing yourself is the beginning of all wisdom.",
                "author" => "Aristotle"
            ]
        ];


        foreach($quotesList as $quoteEntry) {
            $quote = new Quote();
            $quote->setQuote($quoteEntry['quote']);
            $quote->setAuthor($quoteEntry['author']);
        
            $this->entityManager->persist($quote);
        }

        $this->entityManager->flush();

        $quoteRepository = $this->entityManager->getRepository(Quote::class);
        $quoteEntries = $quoteRepository->findBy(['author' => 'Albert Einstein'], ['quote' => 'ASC']);

        // 2 quotes from Einstein in fixture, 2 quotes added in test case
        $this->assertCount(4, $quoteEntries);
        $this->assertEquals("Two things are infinite: the universe and human stupidity; and I'm not sure about the universe.", $quoteEntries[3]->getQuote());


        $quoteEntries = $quoteRepository->findBy(['author' => 'Stephen Chbosky'], ['quote' => 'ASC']);
        $this->assertCount(1, $quoteEntries);
        $this->assertEquals("We accept the love we think we deserve.", $quoteEntries[0]->getQuote());
    }
}
