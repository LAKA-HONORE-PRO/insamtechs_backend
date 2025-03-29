<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Categorie;

class FormationController extends Controller
{
    public function index(Request $request){
        $per_page = $request->input('per_page');
         $formations = Formation::where(["type_formation_id"=>1])->paginate($per_page);

         return response()->json($formations);
    } 


    public function getByCategorie(String $slug, Request $request){

        $categorie = Categorie::where('slug', $slug)->first();

        $per_page = $request->input('per_page');
        $formations = Formation::with('chapitres', 'chapitres.videos')->where(["categorie_id"=>$categorie->id])->paginate($per_page);

        return response()->json($formations);
    }
}
    