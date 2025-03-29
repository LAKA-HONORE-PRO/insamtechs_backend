<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branche;
use App\Models\Domaine;


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
}
