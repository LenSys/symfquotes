<?php

namespace App\DataFixtures;

use App\Entity\Quote;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class QuoteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $quotesList = [
            [
                "quote"  => "Two things are infinite: the universe and human stupidity; and I'm not sure about the universe.",
                "author" => "Albert Einstein"
            ],
            [
                "quote"  => "There are only two ways to live your life. One is as though nothing is a miracle. The other is as though everything is a miracle.",
                "author" => "Albert Einstein"
            ],
            [
                "quote"  => "Be yourself; everyone else is already taken.",
                "author" => "Oscar Wilde"
            ],
            [
                "quote"  => "We accept the love we think we deserve.",
                "author" => "Stephen Chbosky"
            ],
            [
                "quote"  => "If you tell the truth, you don't have to remember anything.",
                "author" => "Mark Twain"
            ],
            [
                "quote"  => "The truth is rarely pure and never simple.",
                "author" => "Oscar Wilde"
            ],
            [
                "quote"  => "In three words I can sum up everything I've learned about life: it goes on.",
                "author" => "Robert Frost"
            ],
            [
                "quote"  => "The only true wisdom is in knowing you know nothing.",
                "author" => "Socrates"
            ]
        ];


        foreach($quotesList as $quoteEntry) {
            $quote = new Quote();
            $quote->setQuote($quoteEntry['quote']);
            $quote->setAuthor($quoteEntry['author']);
        
            $manager->persist($quote);
        }

        $manager->flush();

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
