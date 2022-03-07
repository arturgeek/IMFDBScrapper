<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\MercadoLibreScrapper;
use Illuminate\Support\Str;
use Storage;

class ProductosMercadolibreController extends Controller
{
    private $scrapper = null;
    public function __construct()
    {
        $this->scrapper = new MercadoLibreScrapper(true);
    }

    public function index()
    {
        return view('mercadolibre.index', [] );
    }

    public function getProductData(Request $request)
    {
        $productUrl = $request->get("productUrl");
        $this->scrapper->crawlProduct( $productUrl );

        $productData = $this->scrapper->getProductData();

        $cleanName = str_replace("_", " ", $productData["title"]);
        $productSlug = Str::slug($cleanName);

        return view('mercadolibre.product-data', [
            'productCleanName' => $cleanName,
            'productSlug' => $productSlug,
            'productData' => $productData
        ] );
    }

    public function downloadProductImage(Request $request)
    {
        $imageUrl = $request->get("imageUrl");
        $newImageName = $request->get("newImageName");
        $extension = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION);

        $newImageName .= ".".$extension;

        $contents = file_get_contents($imageUrl);
        Storage::put($newImageName, $contents);

        $headers = array(
            'Content-Disposition' => 'inline',
        );

        return Storage::download($newImageName, $newImageName, $headers);
    }
}
