<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Formation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\FasciculesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\URL;

class FasciculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.fascicule.index', ['fascicules'=>Formation::where('type_formation_id', '=', 3)->orderBy("id", "desc")->simplePaginate(100)]);
        
            // return view('pages.admin.fascicule.index', ['fascicules'=>Formation::where('type_formation_id', '=', 3)->get()]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.fascicule.create', ['categories'=>Categorie::where('type', 3)->orderBy("id", "desc")->get()]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $categorie_id = $request->categorie;
        $intitule = strtolower($request->input('intitule'));
        $langue = strtolower($request->input('langue'));
        $prix = $request->input('prix');
        $nombre_de_points = $request->input('nombre_de_points');
        $duree = $request->input('duree');
        $duree_composition = $request->input('duree_composition');
        $description = 'Fascicule';
        $date = date('d.m.Y');
        $acces = +$request->acces;
        $correction_file = $request->file('correction_file');
        $original_file_name = "";
        $original_file_name_without_extension = "";



        if($request->hasFile('correction_file')){ // teste si le fichier uploader de la correction en est réellemnt un.
            if($correction_file->getClientOriginalExtension() != 'pdf'){ //Teste si le fichier a été uploader au format pdf
                $_SESSION['message'] = array(
                    'type'=>'warning',
                    'title'=>'Echec!',
                    'message'=>'La correction doit être téléversée au format "PDF"!!'
                );

                return redirect()->back();
            }
        }

        $file = '';
        if($request->acces === 0){ // Traitement du fichier ou du lien de l'épreuve
             $file = $request->fichier;
        }
        else{
            
        $fichier = $request->file('fichier');

        if($fichier->getClientOriginalExtension() != 'pdf'){ // Teste si l'épreuve est au format .pdf
            $_SESSION['message'] = array(
                'type'=>'warning',
                'title'=>'Echec!',
                'message'=>'L épreuve doit être téléversée au format "PDF"!!'
            );

            return redirect()->back();
        }

        $original_file_name = $fichier->getClientOriginalName();
        $original_file_name_without_extension = pathinfo($original_file_name, PATHINFO_FILENAME);

        $nomDossier = 'Fasciclues/'.$original_file_name_without_extension;

        $nomSlug = Str::slug($original_file_name_without_extension); // Génère le slug à partir du nom d'origine
        $extension = $fichier->getClientOriginalExtension();
        $nomFichier = $nomSlug .'-'. rand(1, 1000).'.'.$extension;


        $file = Storage::disk('public')->putFileAs($nomDossier, $fichier, $nomFichier); 
        }
       


        if($request->hasFile('correction_file')){ // Traitement du fichier de la correction

            $correction_original_name = $correction_file->getClientOriginalName();
            $correction_original_name_without_extension = pathinfo($correction_original_name, PATHINFO_FILENAME);

            $nomDossier = 'Fasciclues/'.$original_file_name_without_extension.'/Correction';
            $extension = $correction_file->getClientOriginalExtension();
            $nomFichier = $correction_original_name_without_extension.'.'.$extension;

            $correction_file = Storage::disk('public')->putFileAs($nomDossier, $correction_file, $nomFichier);
        }
  

        $translationIntitule = [];
        $translationDescription = [];
        $translationPrix = [];
        $translationLangue = [];

        $languages = ['fr', 'en'];

        $fascicule = new Formation();

        foreach ($languages as $language) {
            $translate = new GoogleTranslate($language);
            $translatedIntitule = $translate->translate($acces === 0 ? $intitule : $original_file_name_without_extension);
            $translatedDescription = $translate->translate($description);
            $translatedPrix = $translate->translate($prix);
            $translatedLangue = $translate->translate($langue);
    
            $translationIntitule[$language] = $translatedIntitule;
            $translationDescription[$language] = $translatedDescription;
            $translationPrix[$language] = $translatedPrix;
            $translationLangue[$language] = $translatedLangue;
            
            try {
    
                $fascicule->categorie_id = $categorie_id;
                $fascicule->type_formation_id = 3;
                $fascicule->setTranslations('intitule', $translationIntitule);
                $fascicule->setTranslations('description', $translationDescription);
                $fascicule->setTranslations('langue_formation', $translationLangue);
                $fascicule->setTranslations('prix', $translationPrix);
                $fascicule->lien = $file;
                $fascicule->correction_link = $correction_file;
                $fascicule->date = $date;
                $fascicule->nombre_de_points = (int)$nombre_de_points;
                $fascicule->duree = $duree;
                $fascicule->duree_composition = $duree_composition;
                $fascicule->generateSlug();
                $fascicule->telechargeable = $acces;

                // dd($fascicule);
                $fascicule->save();
        
    
            
              } catch (\Exception $e) {
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
        'message'=>'Fascicule ajouté avec succès!!'
    );

    return redirect()->route('fascicule.index');

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
       return view('pages.admin.fascicule.update', ['fascicule'=>Formation::where(['slug'=>$slug])->first(), 'categories'=>Categorie::where('type', 3)->get()]);
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
        $description = 'Fascicule';
        $acces = +$request->acces;
        // $correction_file = $request->file('correction_file');
        // $original_file_name = "";
        // $original_file_name_without_extension = "";



        // if($request->hasFile('correction_file')){
        //     if($correction_file->getClientOriginalExtension() != 'pdf'){
        //         $_SESSION['message'] = array(
        //             'type'=>'warning',
        //             'title'=>'Echec!',
        //             'message'=>'La correction doit être téléversée au format "PDF"!!'
        //         );

        //         return redirect()->back();
        //     }
        // }

        $fichier = $request->fichier;
        $date = date('d.m.Y');

        $fascicule = Formation::find($id);


      
       if(!empty($fichier)){
            Storage::disk('public')->delete($fascicule->lien);

            $nomDossier = 'Fasciclues';

            $nomSlug = Str::slug($intitule); // Génère le slug à partir du nom d'origine
            $nomFichier = $nomSlug . rand(1, 1000);
    
    
            $file = Storage::disk('public')->putFileAs($nomDossier, $fichier, $nomFichier);
            // $file = Storage::disk('public')->put('Fasciclues', $fichier);
        }else{
            $file= $fascicule->lien;
        }

        


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
    
                // $formation->categorie_id = $categorie_id;
                // $formation->type_formation_id = 1;
                // $formation->setTranslations('intitule', $translationIntitule);
                // $formation->setTranslations('description', $translationDescription);
                // $formation->setTranslations('prix', $translationPrix);
                // $formation->date = $date;
                // $formation->nombre_de_points = $nombre_de_points;
                // $formation->duree = $duree;
                // $formation->generateSlug();
                // $formation->save();

                $fascicule->categorie_id = $categorie_id;
                $fascicule->type_formation_id = 3;
                $fascicule->setTranslations('intitule', $translationIntitule);
                $fascicule->setTranslations('description', $translationDescription);
                $fascicule->setTranslations('langue_formation', $translationLangue);
                $fascicule->setTranslations('prix', $translationPrix);
                $fascicule->lien = $file;
                $fascicule->date = $date;
                $fascicule->nombre_de_points = $nombre_de_points;
                $fascicule->duree = $duree;
                $fascicule->duree_composition = $duree_composition;
                $fascicule->generateSlug();
                $fascicule->telechargeable = $acces;

                $fascicule->save();
        
        
    
            
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
        'message'=>'Fascicule modifié avec succès!!'
    );

    return redirect()->route('fascicule.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $fascicule = Formation::where('slug', $slug)->first();
       
        // Formation::find($formation->id)->update([
        //     'etat'=>0
        // ]);



        $fascicule->categorie_id = $fascicule->categorie_id;
        $fascicule->type_formation_id = 3;
        $fascicule->intitule = $fascicule->intitule;
        $fascicule->description = $fascicule->description;
        $fascicule->langue_formation = $fascicule->langue_formation;
        $fascicule->prix = $fascicule->prix;
        $fascicule->lien = $fascicule->lie;
        $fascicule->date = $fascicule->date;
        $fascicule->nombre_de_points = $fascicule->nombre_de_points;
        $fascicule->duree = $fascicule->duree;
        $fascicule->duree_composition = $fascicule->duree_composition;
        $fascicule->slug = $fascicule->slug;
        $fascicule->telechargeable = $fascicule->telechargeable;
        $fascicule->etat = 0;

        $fascicule->save();

 
        $_SESSION['message'] = array(
         'type'=>'success',
         'title'=>'Réussite!',
         'message'=>'Fascicule supprimé avec succès!!'
          );
 
 
        return redirect()->route('fascicules_par_categorie');
    }


    public function import_vue()
    {
        return view('pages.admin.fascicule.import');
    }

    public function import_save(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        
        Excel::import(new FasciculesImport, $request->file('file'));
    }


    public function update_etat(Request $request)
    {
        $id = $request->input('booklet_id');

        $fascicule = Formation::findOrFail($id);

        if($fascicule){
            if($fascicule->etat == 0){
                $fascicule->etat = 1;

                $_SESSION['message'] = array(
                    'type'=>'success',
                    'title'=>'Réussite!',
                    'message'=>'Fascicule activé avec succès!!'
                     );
            }else{
                $fascicule->etat = 0;

                $_SESSION['message'] = array(
                    'type'=>'success',
                    'title'=>'Réussite!',
                    'message'=>'Fascicule désactivé avec succès!!'
                     );
            }


            $fascicule->save();

        
        }else{
            $_SESSION['message'] = array(
                'type'=>'error',
                'title'=>'Echec!',
                'message'=>'Fascicule introuvable!!'
                 );
       
        }

        return redirect()->route('fascicules_par_categorie');
    }





    public function hideDownloadReadFile($id){
        $fascicule = Formation::findOrFail($id);

        if($fascicule){
            if (Storage::disk('public')->exists(str_replace('/public/storage/', '', $fascicule->correction_link))) {
               return view('pages.ReadFile', ['link'=>$fascicule->correction_link]);
            }
            abort(404); // Chemin non disponible
        }
    }


}
