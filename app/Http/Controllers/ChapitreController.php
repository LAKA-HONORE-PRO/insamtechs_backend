<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Chapitre;
use App\Models\Formation;
use Illuminate\Http\Request;
use App\Imports\ChapitreImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ChapitreController extends Controller
{

    public function chapitre_create(string $slug)
    {
        $formation = Formation::where('slug', '=', $slug)->first();

        return view('pages.admin.chapitre.create', ['formation'=>$formation]);
    }



    public function chapitre_store(Request $request)
    {
        $formation_id = $request->formation_id;
        $formation = Formation::find($formation_id);

        $intitule = strtolower($request->input('intitule'));
        

        $translationIntitule = [];

        $chapitre = new Chapitre();


        $languages = ['fr', 'en'];


        foreach ($languages as $language) {
           // $translate = new GoogleTranslate($language);
           // $translatedIntitule = $translate->translate($intitule);
    
            $translationIntitule[$language] = $intitule;
            
            try {
    
                $chapitre->formation_id = $formation_id;
                $chapitre->setTranslations('intitule', $translationIntitule);
                $chapitre->generateSlug();
                $chapitre->save();
        
    
            
              } catch (\Exception $e) {
                return redirect()->back();
    
              }
    
    
        }

        $_SESSION['message'] = array(
            'type'=>'success',
            'title'=>'Réussite!',
            'message'=>'Chapitre ajouté avec succès!!'
        );
    
        //return redirect()->route('chapitre_index', $formation->slug);
        return redirect()->back();

    }


    public function chapitre_index(string $slug){
        $formation = Formation::where(['slug'=>$slug])->first();
        return view('pages.admin.chapitre.index', ['chapitres'=>Chapitre::where(['formation_id'=>$formation->id])->get(), 'formation'=>$formation]);
    }


    public function chapitre_edit(string $id)
    {
        $chapitre = Chapitre::find($id);
        $formation = Formation::find($chapitre->formation_id);

        return view('pages.admin.chapitre.update', ['chapitre'=>$chapitre, 'formation'=>$formation]);
    }


    public function chapitre_update(Request $request)
    {
        $formation_id = $request->formation_id;
        $formation = Formation::find($formation_id);


        $intitule = strtolower($request->input('intitule'));
        

        $translationIntitule = [];

        $chapitre = Chapitre::find($request->chapitre_id);
        // dd($chapitre);

        $languages = ['fr', 'en'];


        foreach ($languages as $language) {
           // $translate = new GoogleTranslate($language);
           // $translatedIntitule = $translate->translate($intitule);
    
            $translationIntitule[$language] = $intitule;
            
            try {
    
                $chapitre->formation_id = $formation_id;
                $chapitre->setTranslations('intitule', $translationIntitule);
                $chapitre->generateSlug();

                // dd($chapitre);
                $chapitre->save();
        
    
            
              } catch (\Exception $e) {
                return redirect()->back();
    
              }
    
    
        }


        $_SESSION['message'] = array(
            'type'=>'success',
            'title'=>'Réussite!',
            'message'=>'Chapitre modifié avec succès!!'
        );
    
        return redirect()->route('chapitre_index', $formation->slug);
    }




    public function chapitre_delete(Request $request)
    {
        $chapitre = Chapitre::find($request->id);

        $videos = Video::where('chapitre_id', $chapitre->id)->get();

        if(sizeof($videos) > 0){
            foreach($videos as $video){
                $video->delete();
            }

            $chapitre->delete();
        }
        else{
            $chapitre->delete();
        }

        
        $_SESSION['message'] = array(
            'type'=>'success',
            'title'=>'Réussite!',
            'message'=>'Chapitre supprimé avec succès!!'
        );
        
        return redirect()->back();
    }



    public function import_vue()
    {
        return view('pages.admin.chapitre.import');
    }

    public function import_save(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);   
        
        Excel::import(new ChapitreImport, $request->file('file'));

        return redirect()->back()->withErrors([
          'success'=>'Importation effectuée avec succès',
      ]);
    }

    
    
}
