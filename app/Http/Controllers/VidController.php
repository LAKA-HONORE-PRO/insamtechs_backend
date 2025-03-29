<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Chapitre;
use Illuminate\Support\Str;
use App\Imports\VideoImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Stichoza\GoogleTranslate\GoogleTranslate;

class VidController extends Controller
{
    public function video_index(string $id)
    {
        $chapitre = Chapitre::find($id);

        return view('pages.admin.vid.index', ['videos'=>Video::where(['chapitre_id'=>$chapitre->id])->get(), 'chapitre'=>$chapitre]);
    }


    public function video_create(string $id)
    {
        $chapitre = Chapitre::find($id);

        return view('pages.admin.vid.create', ['chapitre'=>$chapitre]);
    }





    public function video_store(Request $request)
    {
        $chapitre_id = $request->chapitre_id;

        $chapitre = Chapitre::find($chapitre_id);

        $intitule = strtolower($request->input('intitule'));


     //   if (Str::contains($request->input('lien'), 'drive.google.com/')) {
             $lien = $request->input('lien');
             $date = date('d.m.Y');
             



             $translationIntitule = [];

             $video = new Video();
     
     
             $languages = ['fr', 'en'];
     
     
             foreach ($languages as $language) {
               //  $translate = new GoogleTranslate($language);
                // $translatedIntitule = $translate->translate($intitule);
         
                 $translationIntitule[$language] = $intitule;
                 
                 try {
                    // dd($chapitre_id);   
                     $video->chapitre_id = $chapitre_id;
                     $video->setTranslations('intitule', $translationIntitule);
                     $video->lien = $lien;
                     $video->date = $date;
                     $video->generateSlug();
                     $video->save();
             
         
                 
                   } catch (\Exception $e) {
                     return redirect()->back();
         
                   }
         
         
             }
     
             $_SESSION['message'] = array(
                 'type'=>'success',
                 'title'=>'Réussite!',
                 'message'=>'Vidéo ajoutée avec succès!!'
             );
         
             //return redirect()->route('video_index', $chapitre->id);

             return redirect()->back();

      /*  } else {
            $_SESSION['message'] = array(
                'type'=>'warning',
                'title'=>'Echec!',
                'message'=>'Le lien renseigné ne correspond pas au format attendu!!'
            );
        
            return redirect()->back();
        }*/

    }

        


    public function video_edit(string $id)
    {
            $video = Video::find($id);
            $chapitre = Chapitre::find($video->chapitre_id);
            return view('pages.admin.vid.update', ['chapitre'=>$chapitre, 'video'=>$video]);
    }


    public function video_update(Request $request)
    {
        $chapitre_id = $request->chapitre_id;

        $chapitre = Chapitre::find($chapitre_id);



        $intitule = strtolower($request->input('intitule'));


       // if (Str::contains($request->input('lien'), 'embed/')) {
             $lien = $request->input('lien');
             $date = date('d.m.Y');
       
             $translationIntitule = [];

             $video = Video::find($request->video_id);
     
     
             $languages = ['fr', 'en'];
     
     
             foreach ($languages as $language) {
                // $translate = new GoogleTranslate($language);
                // $translatedIntitule = $translate->translate($intitule);
         
                 $translationIntitule[$language] = $intitule;
                 
                 try {
                    // dd($chapitre_id);   
                     $video->chapitre_id = $chapitre_id;
                     $video->setTranslations('intitule', $translationIntitule);
                     $video->lien = $lien;
                     $video->date = $date;
                     $video->generateSlug();
                     $video->save();
             
         
                 
                   } catch (\Exception $e) {
                     return redirect()->back();
         
                   }
         
         
             }
     
             $_SESSION['message'] = array(
                 'type'=>'success',
                 'title'=>'Réussite!',
                 'message'=>'Vidéo modifiée avec succès!!'
             );
         
             return redirect()->route('video_index', $chapitre->id);


        /*} else {
            $_SESSION['message'] = array(
                'type'=>'warning',
                'title'=>'Echec!',
                'message'=>'Le lien renseigné ne correspond pas au format attendu!!'
            );
        
            return redirect()->back();
        }*/
    }



    public function video_delete(Request $request)
    {
        $video = Video::find($request->id);

        $video->delete();

        $_SESSION['message'] = array(
            'type'=>'success',
            'title'=>'Réussite!',
            'message'=>'Vidéo supprimée avec succès!'
        );
    
        return redirect()->back();
    }


    public function import_vue()
    {
        return view('pages.admin.vid.import');
    }

    public function import_save(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);   
        
        Excel::import(new VideoImport, $request->file('file'));

        return redirect()->back()->withErrors([
          'success'=>'Importation effectuée avec succès',
      ]);
    }

  
}
