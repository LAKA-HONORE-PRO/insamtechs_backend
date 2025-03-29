<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Categorie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.categorie.index', ['categories'=>Categorie::orderBy('id', 'desc')->simplePaginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('pages.admin.categorie.create', ['domaines'=>Domaine::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $intitule = strtolower($request->input('intitule'));
        $type = $request->input('type');
        $domaine = "";

        if($request->input('domaine') != ""){
          $domaine = $request->input('domaine');
        }
        else{
          $domaine = null;
        }

        $date = date('d.m.Y');


        $file = '';
        if($request->fichier){

            $fichier = $request->fichier;
            $nomDossier = 'Categories';

            $nomSlug = Str::slug($intitule); // Génère le slug à partir du nom //d'origine
            $nomFichier = $nomSlug . rand(1, 1000);


            $file = Storage::disk('public')->putFileAs($nomDossier, $fichier, $nomFichier); 
        }

        $translationIntitule = [];


        $languages = ['fr', 'en'];

// dd($request);
        $categorie = new Categorie();


      foreach ($languages as $language) {
        //$translate = new GoogleTranslate($language);
       // $translatedIntitule = $translate->translate($intitule);

        $translationIntitule[$language] = $intitule;
        
        try {

            $categorie->domaine_id = $domaine;
            $categorie->setTranslations('intitule', $translationIntitule);
            $categorie->type = $type;
            $categorie->img = $file;
            $categorie->date = $date;
            $categorie->generateSlug();
            $categorie->save();
    

        
          } catch (\Exception $e) {
            dd($e);
            return redirect()->back();

          }


    }


    

    $_SESSION['message'] = array(
        'type'=>'success',
        'title'=>'Réussite!',
        'message'=>'Catégorie ajoutée avec succès!!'
    );

    return redirect()->route('categorie.index');



        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $cat = Categorie::where('slug', $slug)->first();

        $domaine_act = Domaine::find($cat->domaine_id);
      //  dd($domaine_act);
        return view('pages.admin.categorie.update', ['categorie'=>Categorie::where('slug', $slug)->first(), 'domaine_act'=>$domaine_act, 'domaines'=>Domaine::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $intitule = strtolower($request->input('intitule'));
        $type = $request->input('type');




        if($request->input('domaine') != ""){
          $domaine =$request->input('domaine');
        }
        else{
          $domaine = null;
        }

        $date = date('d.m.Y');
        
        $translationIntitule = [];

        $categorie = Categorie::find($id);

      $file = '';
        if($request->fichier){
             $fichier = $request->fichier;

              if(!empty($fichier)){
                // $file=Storage::disk('public')->put('logo',$logo);
                //Storage::disk('public')->delete($categorie->lien);

                $nomDossier = 'Categories';

                $nomSlug = Str::slug($intitule); // Génère le slug à partir du nom d'origine
                $nomFichier = $nomSlug . rand(1, 1000);
        
        
                $file = Storage::disk('public')->putFileAs($nomDossier, $fichier, $nomFichier);
                // $file = Storage::disk('public')->put('Fasciclues', $fichier);
            }else{
                $file= $categorie->img;
            }
      }



        $languages = ['fr', 'en'];
  

        
      foreach ($languages as $language) {
       // $translate = new GoogleTranslate($language);
       // $translatedIntitule = $translate->translate($intitule);

        $translationIntitule[$language] = $intitule;
        
        try {

            $categorie->domaine_id = $domaine;
            $categorie->setTranslations('intitule', $translationIntitule);
            $categorie->type = $type;
            $categorie->img = $file;
            $categorie->date = $date;
            $categorie->generateSlug();
            $categorie->save();

          } catch (\Exception $e) {
            return redirect()->back();

          }

    }


    $_SESSION['message'] = array(
        'type'=>'success',
        'title'=>'Réussite!',
        'message'=>'Catégorie modifiée avec succès!!'
    );

    return redirect()->route('categorie.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    
    public function import_vue()
    {
        return view('pages.admin.categorie.import');
    }

    public function import_save(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);   
        
        Excel::import(new CategoriesImport, $request->file('file'));

        return redirect()->back()->withErrors([
          'success'=>'Importation effectuée avec succès',
      ]);
    }

}
