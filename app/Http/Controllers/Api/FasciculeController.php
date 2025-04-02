<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branche;
use App\Models\Domaine;
use App\Models\Categorie;
use App\Models\Formation;


class FasciculeController extends Controller
{
    public function filieres(Request $request) // Récupération des filières pour la route /fascicules
    {
        $per_page = $request->input('per_page');
        $filieres = Branche::orderBy('intitule', 'asc')->paginate($per_page);
        $other_filieres = Branche::orderBy('intitule', 'asc')->get();

        $datas = [
            "filieres" => $filieres,
            "other_filieres" => $other_filieres
        ];

        return response()->json($datas);
    }


    public function filiere(String $slug) // Récupération d'une filière à partir de son slug
    {
        $filiere = Branche::where('slug', $slug)->first();
        
        if(!$filiere){
            return response()->json([
                "status"=>403,
                "message" => "Cette filière n'a pas été retrouvée !"
            ]);
        }

        return response()->json($filiere);
    }

    public function getSeriesByFiliere(String $slug, Request $request) //Récupération des domaines/séries à partir du slug de la filière.
    {
        $filiere = Branche::where('slug', $slug)->first();
        $per_page = $request->input('per_page');

        if($filiere){
            $series_filiere = Domaine::where('branche_id', $filiere->id)->orderBy('intitule', 'asc')->paginate($per_page);
            $filieres = Branche::orderBy('intitule', 'asc')->get();

            $datas = [
                "series_filiere" => $series_filiere,
                "filieres" => $filieres
            ];

        }else{
            return response()->json([
                "status"=>403,
                "message"=>"Cette filière n'a pas été retrouvée !"
            ]);
        }


        return response()->json( $filiere ? $datas : []);
    }


    public function getSerie(String $slug) //Récupération de la série à partir du slug
    {
        $serie = Domaine::where('slug', $slug)->first();
        
        if(!$serie){
            return response()->json([
                "status"=>403,
                "message" => "Cette série n'a pas été retrouvée !"
            ]);
        }

        return response()->json($serie);
    }

    public function getCategoriesBySerie(String $slug, Request $request) //Récupération des catégroies à partir du slug de la série.
    {
        $serie = Domaine::where('slug', $slug)->first();
        $per_page = $request->input('per_page');

        if($serie){
            $categories_fascicule = Categorie::where('domaine_id', $serie->id)->with('formations')->orderBy('intitule', 'asc')->paginate($per_page);
            $series = Domaine::where('id', '!=', $serie->id)->orderBy('intitule', 'asc')->get();

            $datas = [
                "categories_fascicule" => $categories_fascicule,
                "series" => $series
            ];
        }else{
            return response()->json([
                "status"=>403,
                "message"=>"Cette série n'a pas été retrouvée !"
            ]);
        }

        return response()->json( $serie ? $datas : []);
    }



    public function getCategorie(String $slug)
    {
        $categorie = Categorie::where('slug', $slug)->first();

        if(!$categorie){
            return response()->json([
                "status"=>403,
                "message" => "Cette catégorie n'a pas été retrouvée !"
            ]);
        }

        return response()->json($categorie);
    }


    public function getFasciculesByCategorie(String $slug, Request $request)
    {
        $per_page = $request->input('per_page');
        $categorie = Categorie::where('slug', $slug)->first();

        if(!$categorie){
            return response()->json([
                "status"=>403,
                "message"=>"Cette catégorie n'a pas été retrouvée !"
            ]);
        }

        $fascicules = Formation::where('categorie_id', $categorie->id)->orderBy('intitule', 'asc')->paginate($per_page);
        $other_categories = Categorie::where('id', '!=', $categorie->id)->where(["type"=>3])->orderBy('intitule', 'asc')->get();

        $datas = [
            "fascicules"=>$fascicules,
            "other_categories"=>$other_categories
        ];


        return response()->json($categorie ? $datas : []);
    }
}
