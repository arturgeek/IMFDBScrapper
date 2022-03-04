<?php

namespace App\Tools;

use Exception;
use Goutte\Client;

class Scrapper
{
    protected $client;
    protected $request = null;

    function __construct() {
        $this->client = new Client();
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
