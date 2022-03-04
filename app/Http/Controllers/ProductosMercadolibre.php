<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\MercadoLibreScrapper;

class ProductosMercadolibre extends Controller
{
    private $scrapper = null;
    public function __construct()
    {
        $this->scrapper = new MercadoLibreScrapper();
    }

    public function index()
    {
        return view('welcome', [] );
    }

    public function getMovieFirearms(Request $request)
    {
        $movie = $request->get("movie");
        $this->scrapper->crawlMovie( $movie );

        $categories = $this->scrapper->getCategories();

        $cleanName = str_replace("_", " ", $movie);

        return view('movies.weapons', [ 'movieCleanName' => $cleanName, 'movieSlug' => $movie, 'categories' => $categories ]);
    }
}
