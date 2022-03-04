<?php

namespace App\Tools;

class MercadoLibreScrapper extends Scrapper
{
    private $client;
    const ML_URL = 'http://www.imfdb.org';
    private $categories = [];

    public function crawlArticle( $url )
    {
        $this->request = $this->client->request('GET', $url);
    }

    private function getArticleContent()
    {
        return "Article Content";
    }
}
