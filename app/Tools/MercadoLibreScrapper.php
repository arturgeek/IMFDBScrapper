<?php

namespace App\Tools;

class MercadoLibreScrapper extends Scrapper
{
    private $commonElements = [
        "title" => [
            "selector" => "h1",
            "attribute" => null,
            "single" => true
        ],
        "price" => [
            "selector" => ".andes-money-amount meta",
            "attribute" => "content",
            "single" => true
        ],
        "images" => [
            "selector" => "figure .ui-pdp-image",
            "attribute" => "data-zoom",
            "single" => false
        ],
        "highlighed" => [
            "selector" => ".ui-vpp-highlighted-specs__features-list-item",
            "attribute" => null,
            "single" => false
        ],
        "content" => [
            "selector" => ".ui-pdp-description__content",
            "attribute" => null,
            "single" => true
        ]
    ];

    const ML_URL = 'http://www.imfdb.org';
    private $product = [];

    public function crawlProduct( $url )
    {
        $this->request = $this->client->request('GET', $url, ['verify' => false]);
        $this->fillProductContent();
    }

    private function fillProductContent()
    {
        $this->fillCommonElements();
        $this->fillProductFeatures();
    }

    private function fillCommonElements()
    {
        foreach( $this->commonElements as $key => $element )
        {
            if( $element["single"] )
            {
                $this->product[$key] = $this->getSingleValueFromDom( $element );
            }
            else
            {
                $nodes = $this->getNodesFromDom( $element["selector"] );
                $elements = [];
                foreach( $nodes as $node )
                {
                    $elements[] = $this->getValue( $node, $element["attribute"] );
                }

                $this->product[$key] = $elements;
            }
        }
    }

    private function fillProductFeatures()
    {
        $featuresNodes = $this->getNodesFromDom(".ui-vpp-striped-specs__table");
        $features = [];
        foreach( $featuresNodes as $node )
        {
            $header = $node->children(".ui-vpp-striped-specs__header");
            $featuresTitle = $this->getValue($header);


            $featuresDetail = [];

            $tableRow = $node->children(".andes-table .andes-table__body .andes-table__row");
            foreach( $tableRow as $row )
            {
                $featureTitle = $row->firstChild->nodeValue;
                $featureValue = $row->lastChild->firstChild->nodeValue;

                $featuresDetail[] = $featureTitle.": ".$featureValue;
            }

            $features[$featuresTitle] = $featuresDetail;
        }

        $this->product["features"] = $features;
    }

    public function getProductData()
    {
        return $this->product;
    }
}
