<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tools\IMFDBScrapper;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Weapon;
use App\Models\WeaponsInMovies;

class MovieController extends Controller
{
    private $scrapper = null;
    public function __construct()
    {
        $this->scrapper = new IMFDBScrapper();
    }

    public function index()
    {
        $featured = $this->scrapper->crawlFeaturedArticle();

        $allFavoriteWeapons = Weapon::all()->toArray();
        return view('imfdb', [ "featured" => $featured, "favorites" => $allFavoriteWeapons ]  );
    }

    public function getMovieFirearms(Request $request)
    {
        $movie = $request->get("movie");
        $this->scrapper->crawlMovie( $movie );

        $categories = $this->scrapper->getCategories();

        $cleanName = str_replace("_", " ", $movie);

        return view('movies.weapons', [ 'movieCleanName' => $cleanName, 'movieSlug' => $movie, 'categories' => $categories ]);
    }

    public function saveWeaponToFavorites(Request $request)
    {
        $this->saveFavoriteWeapon($request);

        return $this->index();
    }

    private function saveFavoriteWeapon( $request )
    {
        $movie = Movie::firstOrCreate([
            "name" => $request->get("movie"),
            "slug" => $request->get("movie_slug")
        ]);

        $categoryName = $request->get("category");
        $categorySlug = strtolower( str_replace(" ", "_", $categoryName) );
        $category = Category::firstOrCreate([
            "slug" => $categorySlug,
            "name" => $categoryName
        ]);

        $weapon = Weapon::updateOrCreate([
            "category_id" => $category->id,
            "name" => $request->get("weapon"),
        ]);

        $weapon->image_url = $request->get("image_url");
        $weapon->save();

        return WeaponsInMovies::firstOrCreate([
            "movie_id" => $movie->id,
            "weapon_id" => $weapon->id
        ]);
    }
}
