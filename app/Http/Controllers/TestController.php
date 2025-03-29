<?php

namespace App\Http\Controllers;

use App\Models\TestModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\DB;

class TestController extends Controller 
{
    public function test(Request $request)
    {

        // $article = new TestModel;
        // $article->setTranslations('titre', $request->titre);
        // $article->setTranslations('body', $request->body);
        // $article->save();

        // return redirect()->back();


      // Récupérer les informations renseignées par l'utilisateur
      $title = $request->input('titre');
      $content = $request->input('body');
  
      // Traduire les informations dans d'autres langues
      $translationtitle = [];
      $translationbody = [];
  
      $languages = ['fr', 'en']; // Langues prises en charge, ajoutez d'autres langues si nécessaire
  
    //   foreach ($languages as $language) {
    //       if ($language !== app()->getLocale()) {
    //           $translate = new GoogleTranslate($language);
    //           $translatedTitle = $translate->translate($title);
    //           $translatedContent = $translate->translate($content);
  
    //         //   $translations[$language] = [
    //         //       'titre' => $translatedTitle,
    //         //       'body' => $translatedContent
    //         //   ];
    //       }   
    //   }

    $article = new TestModel();

    foreach ($languages as $language) {
        $translate = new GoogleTranslate($language);
        $translatedTitle = $translate->translate($title);
        $translatedContent = $translate->translate($content);

        $translationtitle[$language] = $translatedTitle;
  

        $translationbody[$language] =  $translatedContent;


    }

//     dd($translationbody, $translationbody);
// exit();



    //   DB::beginTransaction();

      try {


        $article->setTranslations('titre', $translationtitle);
        $article->setTranslations('body', $translationbody);
    // dd($article);
    // exit();
        $article->save();

 
    //       $article = new TestModel();
    //       $article->titre = $title;
    //       $article->body = $content;
    //       $article->translations = $translations;
    //         // dd($article);
    //         // exit
    //       $article->save();
  
    //     //   DB::commit();
  
    //       // Afficher un message de confirmation à l'utilisateur
    //       // ...
      } catch (\Exception $e) {
        return redirect()->back();

  
          // Gérer l'erreur de sauvegarde dans la base de données
          // ...
      }


    }

}
