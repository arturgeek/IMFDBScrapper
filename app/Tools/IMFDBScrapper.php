<?php

namespace App\Tools;

class IMFDBScrapper extends Scrapper
{
    const IMFDB_URL = 'http://www.imfdb.org';
    const ACCEPTED_CATEGORIES = [
        "Handguns",
        "Submachine Guns",
        "Shotguns",
        "Rifles",
        "Machine Guns",
        "Other",
    ];

    private $categories = [];

    public $request = null;

    public function crawlFeaturedArticle()
    {
        $url = self::IMFDB_URL."/wiki/Main_Page";
        $this->request = $this->client->request('GET', $url);
        $node = $this->getNodesFromDom("#mp-left b a");

        if( count($node) > 0 )
        {
            $node = $node[0];
            $url = $node->attr("href");
            $url = str_replace("/wiki/", "", $url);

            $nodeImage = $this->getNodesFromDom("#mp-left .thumbimage");
            $image = "";
            if( count($nodeImage) > 0 )
            {
                $nodeImage = $nodeImage[0];
                $image = self::IMFDB_URL.$nodeImage->attr("src");
            }

            return [
                "name" => $node->text(),
                "url" => $url,
                "image_url" => $image
            ];
        }
        return [];

    }

    public function crawlMovie( $movie )
    {
        $url = self::IMFDB_URL."/wiki/".$movie;
        $this->request = $this->client->request('GET', $url);
        $this->fillValuesFromRequest();
    }

    public function getCategories()
    {
        return $this->categories;
    }

    private function fillValuesFromRequest()
    {
        $titlesNodes = $this->getNodesFromDom(".mw-headline");
        $lastCategory = null;
        foreach( $titlesNodes as $node )
        {
            $parent = $node->parents();
            $nodeType = $parent->nodeName();
            $nodeText = $node->text();
            if( $nodeType === "h1" )
            {
                $lastCategory = $this->checkCategory( $nodeText );
            }

            if( $nodeType === "h2" )
            {
                $this->addWeaponToCategory($lastCategory, $parent, $nodeText);
            }
        }
    }

    private function addWeaponToCategory( $category, $parent, $weapon )
    {
        if( in_array($category, self::ACCEPTED_CATEGORIES) )
        {
            $image = $this->getWeaponImage( $parent );

            $this->categories[$category][] = [
                "name" => $weapon,
                "image" => $image
            ];
        }
    }

    private function getWeaponImage( $parent )
    {
        $image = "";
        $maxCount = 0;
        while ( $maxCount < 5 && $image == null ) {

            $next = $parent->nextAll();
            $filtered = $next->filter(".thumbimage");
            if ($filtered->count()){
                $image = self::IMFDB_URL.$filtered->attr("src");
            }

            $maxCount++;
        }
        return $image;
    }

    private function checkCategory( $category )
    {
        if( in_array($category, self::ACCEPTED_CATEGORIES) )
        {
            $this->createCategoryIfNotAvailable( $category );
            return $category;
        }
        return null;


    }

    private function createCategoryIfNotAvailable( $category )
    {
        if( !isset($this->categories[$category]) )
        {
            $this->categories[$category] = [];
        };
    }
}
