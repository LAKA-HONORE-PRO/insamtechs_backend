<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Formation;

class JobDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');
        $categories_jobs = Categorie::where(["type"=>4])->with('formations')->orderBy('intitule', 'asc')->paginate($per_page);
        $other_categories = Categorie::where(["type"=>4])->orderBy('intitule', 'asc')->get();

        $datas = [
            "categories_jobs" => $categories_jobs,
            "other_categories" => $other_categories
        ];

        return response()->json($datas);
    }



    public function getJobByCategorie(String $slug, Request $request)
    {
        $per_page = $request->input('per_page');
        $categorie = Categorie::where('slug', $slug)->first();

        if(!$categorie){
            return response()->json([
                "status"=>403,
                "message"=>"Cette catégorie n'a pas été retrouvée"
            ]);
        }

        $other_categories = Categorie::where(["type"=>4])->where("slug", '!=', $slug)->orderBy('intitule', 'asc')->get();
        $jobs_descriptions = Formation::where(["categorie_id"=>$categorie->id])->paginate($per_page);


        $datas = [
            "categorie" => $categorie,
            "jobs_descriptions" => $jobs_descriptions,
            "other_categories"=>$other_categories,
        ];

        return response()->json($datas);
    }
}
