<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Categorie;

class VideothequeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');
        $categories = Categorie::where(["type"=>1])->orderBy('intitule', 'asc')->with('formations')->paginate($per_page);

        $all_categories = Categorie::where(["type"=>1])->orderBy('intitule', 'asc')->with('formations')->get();

        $datas = [
            "categories" => $categories,
            "all_categories" => $all_categories
        ];
        
        return response()->json($datas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $categorie = Categorie::where(["type"=>1, "slug"=>$slug])->orderBy('intitule', 'asc')->first();
        $other_categories = Categorie::where(["type"=>1])->where("slug", '!=', $slug)->orderBy('intitule', 'asc')->get();

        if(!$categorie){
            return response()->json([
                "status"=>403,
                "message"=>"Cette catégorie n'a pas été retrouvée"
            ]);
        }

        $datas = [
            "categorie"=>$categorie,
            "other_categories"=>$other_categories,
        ];

        return response()->json($datas);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
