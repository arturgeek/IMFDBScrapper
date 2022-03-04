<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\MercadoLibreScrapper;

class ProductosMercadolibreController extends Controller
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
}
