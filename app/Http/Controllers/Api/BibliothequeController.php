<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Formation;

class BibliothequeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');
        $categories = Categorie::where(["type"=>2])->orderBy('intitule', 'asc')->with('formations')->paginate($per_page);


        $all_categories = Categorie::where(["type"=>2])->orderBy('intitule', 'asc')->with('formations')->get();

        $datas = [
            "categories" => $categories,
            "all_categories" => $all_categories
        ];
        
        return response()->json($datas);
    }

    public function getByCategorie(String $slug, Request $request){

        $categorie = Categorie::where('slug', $slug)->first();
        $other_categories = Categorie::where(["type"=>2])->where("slug", '!=', $slug)->orderBy('intitule', 'asc')->get();
        $per_page = $request->input('per_page');
        $livres = Formation::where(["categorie_id"=>$categorie->id])->paginate($per_page);

        if(!$categorie){
            return response()->json([
                "status"=>403,
                "message"=>"Cette catégorie n'a pas été retrouvée"
            ]);
        }


        $datas = [
            "categorie" => $categorie,
            "livres" => $livres,
            "other_categories"=>$other_categories,
        ];

        return response()->json($datas);
    }

}
