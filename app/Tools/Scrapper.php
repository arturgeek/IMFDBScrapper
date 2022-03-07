<?php

namespace App\Tools;

use Exception;
use Goutte\Client;

class Scrapper
{
    protected $client;
    protected $request = null;

    function __construct( $disableSSL = false ) {
        $this->client = new Client();
        if( $disableSSL )
        {
           // $this->client->getClient()->setDefaultOption('config/curl/' . CURLOPT_SSL_VERIFYPEER, false);
        }
    }

    protected function getSingleValueFromDom( $element )
    {
        $nodes = $this->getNodesFromDom( $element["selector"] );

        if( count($nodes) == 0 ){
            return "";
        }

        return $this->getValue( $nodes[0], $element["attribute"] );
    }

    protected function getValue( $node, $attribute = null )
    {
        if( $attribute === null )
        {
            return $node->text();
        }

        if( $attribute !== null )
        {
            return $node->attr( $attribute );
        }

        return "";
    }

    protected function getNodesFromDom( $selector )
    {
        if( $this->request == null )
        {
            dd("Crawler not valid");
        }

        $values = [];
        $this->request->filter($selector)->each(function ($node) use (&$values) {
            $values[] = $node;
        });
        return $values;
    }
}
