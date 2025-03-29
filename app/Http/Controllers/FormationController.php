<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Formation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\FormationImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('pages.admin.formation.index', ['formations'=>Formation::where('type_formation_id', '=', 1)->simplePaginate(100)]);
        
        return view('pages.admin.formation.index', ['formations'=>Formation::where('type_formation_id', '=', 1)->orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('pages.admin.formation.create', ['categories'=>Categorie::where('type', 1)->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categorie_id = $request->categorie;
        $intitule = strtolower($request->input('intitule'));
        $langue = strtolower($request->input('langue'));
        $prix = $request->input('prix');
        $nombre_de_points = $request->input('nombre_de_points');
        $duree = $request->input('duree');
        $duree_composition = $request->input('duree_composition');
        $description = $request->input('description');
        $date = date('d.m.Y');


        $file = '';
        if($request->fichier){
            
            $fichier = $request->fichier;
            $nomDossier = 'Formations';

            $nomSlug = Str::slug($intitule); // Génère le slug à partir du nom //d'origine
            $nomFichier = $nomSlug . rand(1, 1000);


            $file = Storage::disk('public')->putFileAs($nomDossier, $fichier, $nomFichier); 
        }

        $translationIntitule = [];
        $translationDescription = [];
        $translationPrix = [];
        $translationLangue = [];


        $languages = ['fr', 'en'];


        $formation = new Formation();


        foreach ($languages as $language) {
           // $translate = new GoogleTranslate($language);
           // $translatedIntitule = $translate->translate($intitule);
           // $translatedDescription = $translate->translate($description);
           // $translatedPrix = $translate->translate($prix);
           // $translatedLangue = $translate->translate($langue);
    
            $translationIntitule[$language] = $intitule;
            $translationDescription[$language] = $description;
            $translationPrix[$language] = $prix;
            $translationLangue[$language] = $langue;
            
            try {
    
                $formation->categorie_id = $categorie_id;
                $formation->type_formation_id = 1;
                $formation->setTranslations('intitule', $translationIntitule);
                $formation->setTranslations('description', $translationDescription);
                $formation->setTranslations('langue_formation', $translationLangue);
                $formation->setTranslations('prix', $translationPrix);
                $formation->date = $date;
                $formation->nombre_de_points = $nombre_de_points;
                $formation->duree = $duree;
                $formation->duree_composition = $duree_composition;
                $formation->generateSlug();
                $formation->img = $file;

                // dd($formation);
                $formation->save();
        
    
            
              } catch (\Exception $e) {
                return redirect()->back();
    
              }
    

    }


    
    
    $_SESSION['message'] = array(
        'type'=>'success',
        'title'=>'Réussite!',
        'message'=>'Formation ajoutée avec succès!!'
    );

    return redirect()->route('formation.index');

  
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
        $formation = Formation::where(['slug'=>$slug])->first();
        // $categories = Categorie::where('categorie_id', '=', $formation->categorie_id)->get();

        // dd($categories);

        return view('pages.admin.formation.update', ['formation'=> $formation, 'categories'=>Categorie::where('type', 1)->get()] );
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categorie_id = $request->categorie;
        $intitule = strtolower($request->input('intitule'));
        $langue = strtolower($request->input('langue'));
        $prix = $request->input('prix');
        $nombre_de_points = $request->input('nombre_de_points');
        $duree = $request->input('duree');
        $duree_composition = $request->input('duree_composition');
        $description = $request->input('description');
        $date = date('d.m.Y');
        $fichier = $request->fichier;

        $translationIntitule = [];
        $translationDescription = [];
        $translationPrix = [];
        $translationLangue = [];



        $formation = Formation::find($id);



        if(!empty($fichier)){
            // $file=Storage::disk('public')->put('logo',$logo);
            //Storage::disk('public')->delete($formation->img);

            $nomDossier = 'Formations';

            $nomSlug = Str::slug($intitule); // Génère le slug à partir du nom d'origine
            $nomFichier = $nomSlug . rand(1, 1000);
    
    
            $file = Storage::disk('public')->putFileAs($nomDossier, $fichier, $nomFichier);
            // $file = Storage::disk('public')->put('Fasciclues', $fichier);
        }else{
            $file= $formation->img;
        }


        $languages = ['fr', 'en'];


        foreach ($languages as $language) {
          //  $translate = new GoogleTranslate($language);
          //  $translatedIntitule = $translate->translate($intitule);
          //  $translatedDescription = $translate->translate($description);
          //  $translatedPrix = $translate->translate($prix);
          //  $translatedLangue = $translate->translate($langue);
    
            $translationIntitule[$language] = $intitule;
            $translationDescription[$language] = $description;
            $translationPrix[$language] = $prix;
            $translationLangue[$language] = $langue;
            
            try {

                $formation->categorie_id = $categorie_id;
                $formation->type_formation_id = 1;
                $formation->setTranslations('intitule', $translationIntitule);
                $formation->setTranslations('description', $translationDescription);
                $formation->setTranslations('langue_formation', $translationLangue);
                $formation->setTranslations('prix', $translationPrix);
                $formation->date = $date;
                $formation->nombre_de_points = $nombre_de_points;
                $formation->duree = $duree;
                $formation->duree_composition = $duree_composition;
                $formation->generateSlug();
                $formation->img = $file;
                $formation->save();
        
        
    
            
              } catch (\Exception $e) {
                return redirect()->back();
              }
    

    }

    
    $_SESSION['message'] = array(
        'type'=>'success',
        'title'=>'Réussite!',
        'message'=>'Formation modifiée avec succès!!'
    );

    return redirect()->route('formation.index');

  
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
        return view('pages.admin.formation.import');
    }

    public function import_save(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        
        Excel::import(new FormationImport, $request->file('file'));

        return redirect()->back()->withErrors([
            'success'=>'Importation effectuée avec succès',
        ]);
    }

}
