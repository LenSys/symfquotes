<?php

namespace App\Test;

use App\Repository\QuoteRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class QuotesControllerTest extends WebTestCase
{
    public function testGetQuotesRouteWorks(): void
    {
        /** KernelBrowser */
        $client = $this->createClient();

        $client->request(method:"GET", uri:"/quotes");

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        // $this->assertJson("", $client->getResponse()->getContent());
    }

    
    /*
    public function testGetQuoteAuthorRouteFailsWithMissingRequiredParameterAuthor(): void
    {
        /** KernelBrowser * /
        $client = $this->createClient();

        $this->expectException(NotFoundHttpException::class);
        $client->request(method:"GET", uri:"/quote/");

        $quotesJsonFile = __DIR__ . "/../Fixtures/empty-quotes.json";
        $this->assertJsonStringEqualsJsonFile($quotesJsonFile, $client->getResponse()->getContent());
        $this->assertSame(404, $client->getResponse()->getStatusCode());
    }
    */


    /*
    public function testGetQuoteAuthorRouteWorks(): void
    {
        /** KernelBrowser * /
        $client = $this->createClient();
        $client->request(method:"GET", uri:"/quote/albert-einstein");

        // $quotesJsonFile = __DIR__ . "/../Fixtures/quotes.json";
        // $this->assertJsonStringEqualsJsonFile($quotesJsonFile, $client->getResponse()->getContent());
        $this->assertSame(404, $client->getResponse()->getStatusCode());
    }
    */
}
