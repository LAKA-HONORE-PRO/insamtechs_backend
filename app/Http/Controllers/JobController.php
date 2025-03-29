<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Formation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JobDescriptionImport;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('pages.admin.job.index', ['jobs'=>Formation::where('type_formation_id', '=', 4)->orderBy('id', 'desc')->simplePaginate(100)]);

        // return view('pages.admin.job.index', ['jobs'=>Formation::where('type_formation_id', '=', 4)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.job.create', ['categories'=>Categorie::where('type', 4)->get()]);
        
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
        $description = 'Jobs';
        $date = date('d.m.Y');
        $acces = 0;
        
        
        $file = '';
        if($request->acces == 0){
             $file = $request->fichier;
        }
        else{
            
        $fichier = $request->fichier;
        $nomDossier = 'Jobs';

        $nomSlug = Str::slug($intitule); // Génère le slug à partir du nom //d'origine
        $nomFichier = $nomSlug . rand(1, 1000);


        $file = Storage::disk('public')->putFileAs($nomDossier, $fichier, $nomFichier); 
        }
       
        
    // dd($request);
        



 


        $translationIntitule = [];
        $translationDescription = [];
        $translationPrix = [];
        $translationLangue = [];

        $languages = ['fr', 'en'];

        $job = new Formation();



        foreach ($languages as $language) {
            $translate = new GoogleTranslate($language);
            $translatedIntitule = $translate->translate($intitule);
            $translatedDescription = $translate->translate($description);
            $translatedPrix = $translate->translate($prix);
            $translatedLangue = $translate->translate($langue);
    
            $translationIntitule[$language] = $translatedIntitule;
            $translationDescription[$language] = $translatedDescription;
            $translationPrix[$language] = $translatedPrix;
            $translationLangue[$language] = $translatedLangue;
            
            try {
    
                $job->categorie_id = $categorie_id;
                $job->type_formation_id = 4;
                $job->setTranslations('intitule', $translationIntitule);
                $job->setTranslations('description', $translationDescription);
                $job->setTranslations('langue_formation', $translationLangue);
                $job->setTranslations('prix', $translationPrix);
                $job->lien = $file;
                $job->date = $date;
                $job->nombre_de_points = (int)$nombre_de_points;
                $job->duree = $duree;
                $job->duree_composition = $duree_composition;
                $job->generateSlug();
                $job->telechargeable = $acces;

                // dd($job);
                $job->save();
        
    
            
              } catch (\Exception $e) {
                // dd($e);

                      $_SESSION['message'] = array(
                            'type'=>'error',
                            'title'=>'Echec!',
                            'message'=>'Une erreur est survenue!!'
                        );

                return redirect()->back();
                // exit;
    
              }

              

    }


    
    
    $_SESSION['message'] = array(
        'type'=>'success',
        'title'=>'Réussite!',
        'message'=>'Job Description ajouté avec succès!!'
    );

    return redirect()->route('job.index');

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
       return view('pages.admin.job.update', ['job'=>Formation::where(['slug'=>$slug])->first(), 'categories'=>Categorie::where('type', 4)->get()]);
        
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
        $description = 'Jobs';
        $acces = 0;

        $file = $request->fichier;
        $date = date('d.m.Y');

        $job = Formation::find($id);


      
    //    if(!empty($fichier)){
    //         // $file=Storage::disk('public')->put('logo',$logo);
    //         Storage::disk('public')->delete($job->lien);

    //         $nomDossier = 'Jobs';

    //         $nomSlug = Str::slug($intitule); // Génère le slug à partir du nom d'origine
    //         $nomFichier = $nomSlug . rand(1, 1000);
    
    
    //         $file = Storage::disk('public')->putFileAs($nomDossier, $fichier, $nomFichier);
    //         // $file = Storage::disk('public')->put('Fasciclues', $fichier);
    //     }else{
    //         $file= '';
    //     }

        


        $translationIntitule = [];
        $translationDescription = [];
        $translationPrix = [];
        $translationLangue = [];

        $languages = ['fr', 'en'];





        
        $languages = ['fr', 'en'];


        foreach ($languages as $language) {
            $translate = new GoogleTranslate($language);
            $translatedIntitule = $translate->translate($intitule);
            $translatedDescription = $translate->translate($description);
            $translatedPrix = $translate->translate($prix);
            $translatedLangue = $translate->translate($langue);
    
            $translationIntitule[$language] = $translatedIntitule;
            $translationDescription[$language] = $translatedDescription;
            $translationPrix[$language] = $translatedPrix;
            $translationLangue[$language] = $translatedLangue;
            
            try {

                $job->categorie_id = $categorie_id;
                $job->type_formation_id = 4;
                $job->setTranslations('intitule', $translationIntitule);
                $job->setTranslations('description', $translationDescription);
                $job->setTranslations('langue_formation', $translationLangue);
                $job->setTranslations('prix', $translationPrix);
                $job->lien = $file;
                $job->date = $date;
                $job->nombre_de_points = $nombre_de_points;
                $job->duree = $duree;
                $job->duree_composition = $duree_composition;
                $job->generateSlug();
                $job->telechargeable = $acces;

                $job->save();
        
        
    
            
              } catch (\Exception $e) {

                      $_SESSION['message'] = array(
                        'type'=>'warning',
                        'title'=>'Erreur!',
                        'message'=>'Erreur lors de la modification!!'
                    );
                    return redirect()->back();
    
              }
    

    }

    
    $_SESSION['message'] = array(
        'type'=>'success',
        'title'=>'Réussite!',
        'message'=>'Job Description modifié avec succès!!'
    );

    return redirect()->route('job.index');

  


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $job = Formation::where('slug', $slug)->first();


        $job->categorie_id = $job->categorie_id;
        $job->type_formation_id = 3;
        $job->intitule = $job->intitule;
        $job->description = $job->description;
        $job->langue_formation = $job->langue_formation;
        $job->prix = $job->prix;
        $job->lien = $job->lie;
        $job->date = $job->date;
        $job->nombre_de_points = $job->nombre_de_points;
        $job->duree = $job->duree;
        $job->duree_composition = $job->duree_composition;
        $job->slug = $job->slug;
        $job->telechargeable = $job->telechargeable;
        $job->etat = 0;

        $job->save();

 
        $_SESSION['message'] = array(
         'type'=>'success',
         'title'=>'Réussite!',
         'message'=>'Job Description supprimé avec succès!!'
          );
 
 
        return redirect()->route('fascicules_par_categorie');
    }


    public function import_vue()
    {
        return view('pages.admin.job.import');
    }

    public function import_save(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);   
        
        Excel::import(new JobDescriptionImport, $request->file('file'));

        return redirect()->back()->withErrors([
          'success'=>'Importation effectuée avec succès',
      ]);
    }

}
