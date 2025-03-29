<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Categorie;

class ConfigController extends Controller
{
    public function index(){
        $categories_video_en = Categorie::where(["type"=>1, "langue"=>"anglais"])->orderBy('id', 'desc')->with('formations')->take(8)->get();
        $categories_video_fr = Categorie::where(["type"=>1, "langue"=>"français"])->orderBy('id', 'desc')->with('formations')->take(8)->get();
        $formations = Formation::where(["type_formation_id"=>1])->with('chapitres', 'chapitres.videos')->inRandomOrder()->take(10)->get();
        $categories_bibliotheque = Categorie::where(["type"=>2])->inRandomOrder()->with('formations')->take(6)->get();
        $categories_fascicule = Categorie::where(["type"=>3])->inRandomOrder()->with('formations')->take(6)->get();

       
        $datas = [
            "categories_video_en"=> $categories_video_en,
            "categories_video_fr"=> $categories_video_fr,
            "formations_selection" => $formations,
            "categories_bibliotheque" => $categories_bibliotheque,
            "categories_fascicule" => $categories_fascicule,
        ];
        return response()->json($datas);
    } 
}
