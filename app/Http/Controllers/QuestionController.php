<?php

namespace App\Http\Controllers;

use App\Models\Reponse;
use App\Models\Question;
use App\Models\Formation;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class QuestionController extends Controller
{
    
    public function question_create(string $slug)
    {
        $fascicule = Formation::where('slug', '=', $slug)->first();

        return view('pages.admin.question.create', ['fascicule'=>$fascicule]);
    }



    public function question_store(Request $request)
    {
        // dd($request);
        $fascicule_id = $request->fascicule_id;
        $intitule = strtolower($request->intitule);
        // $p1 = strtolower($request->question_une);
        // $p2 = strtolower($request->question_deux);
        // $p3 = strtolower($request->question_trois);
        // $p4 = strtolower($request->question_quatre);
        $points = $request->points;
        // $bonne_reponse = strtolower($request->bonne_reponse);


        $total_points_allouer = Question::where(['formation_id'=>$fascicule_id])->sum('nombre_de_points');

        // dd($total_points_allouer, (int)$points);

        $fascicule = Formation::find($fascicule_id);

        // dd($total_points_allouer);

        if((int)$total_points_allouer == (int)$fascicule->nombre_de_points){
            $_SESSION['message'] = array(
                'type'=>'warning',
                'title'=>'Echec!',
                'message'=>'Vous avez atteint le Nombre total des points prévus pour ce fascicule!!'
            );
        
            return redirect()->route('create_question', $fascicule->slug);
        }
        else if((int)$total_points_allouer + (int)$points > $fascicule->nombre_de_points){
            $_SESSION['message'] = array(
                'type'=>'error',
                'title'=>'Echec!',
                'message'=>'Le nombre de points restant pour atteindre le total de points prévus pour ce fascicule est : '.(int)$fascicule->nombre_de_points - (int)$total_points_allouer.' points !'
            );
        
            return redirect()->route('create_question', $fascicule->slug);  
        }
        else{

            $translationIntitule = [];
            // $translationQuestionUne = [];
            // $translationQuestionDeux = [];
            // $translationQuestionTrois = [];
            // $translationQuestionQuatre = [];
            // $translationBonneReponse = [];


            $question = New Question();

            $languages = ['fr', 'en'];


            foreach ($languages as $language) {
                $translate = new GoogleTranslate($language);
                $translatedIntitule = $translate->translate($intitule);
                // $translatedQuestionUne = $translate->translate($p1);
                // $translatedQuestionDeux = $translate->translate($p2);
                // $translatedQuestionTrois = $translate->translate($p3);
                // $translatedQuestionQuatre = $translate->translate($p4);
                // $translatedBonneReponse = $translate->translate($bonne_reponse);
        
                $translationIntitule[$language] = $translatedIntitule;
                // $translationQuestionUne[$language] = $translatedQuestionUne;
                // $translationQuestionDeux[$language] = $translatedQuestionDeux;
                // $translationQuestionTrois[$language] = $translatedQuestionTrois;
                // $translationQuestionQuatre[$language] = $translatedQuestionQuatre;
                // $translationBonneReponse[$language] = $translatedBonneReponse;
                
                try {
        
                    $question->formation_id = $fascicule_id;
                    $question->type = 1;
                    $question->setTranslations('intitule', $translationIntitule);
                    $question->nombre_de_points = $points;
                    // $question->setTranslations('question_une', $translationQuestionUne);
                    // $question->setTranslations('question_deux', $translationQuestionDeux);
                    // $question->setTranslations('question_trois', $translationQuestionTrois);
                    // $question->setTranslations('question_quatre', $translationQuestionQuatre);
                    // $question->setTranslations('bonne_reponse', $translationBonneReponse);
                    $question->generateSlug();
                    $question->save();

    
         
        
                    
                    /*$reponse->question_id = 2;
                    $reponse->setTranslations('question_une', $translationQuestionUne);
                    $reponse->save();

                    $reponse->setTranslations('question_deux', $translationQuestionDeux);
                    $reponse->save();

                    $reponse->setTranslations('question_trois', $translationQuestionTrois);
                    $reponse->save();

                    $reponse->setTranslations('question_quatre', $translationQuestionQuatre);
                    $reponse->save();*/

                
                  } catch (\Exception $e) {
                    return redirect()->back();
        
                  }
        
        
            }
    
            $_SESSION['message'] = array(
                'type'=>'success',
                'title'=>'Réussite!',
                'message'=>'Question ajoutée avec succès!!'
            );
        
            return redirect()->route('question_index', $fascicule->slug);
    


        }
        
    }


    public function question_index(string $slug){
        $fascicule = Formation::where(['slug'=>$slug])->first();
       return view('pages.admin.question.index', ['questions'=>Question::where(['formation_id'=>$fascicule->id])->get(), 'fascicule'=>$fascicule]);
    }


    public function question_edit(string $id)
    {
        $question = Question::find($id);
        return view('pages.admin.question.update', ['question'=>$question, 'fascicule'=>Formation::find($question->formation_id)]);
    }


    public function question_update(Request $request)
    {

        $fascicule_id = $request->fascicule_id;
        $question_id = $request->question_id;

        $intitule = strtolower($request->intitule);
        // $p1 = strtolower($request->question_une);
        // $p2 = strtolower($request->question_deux);
        // $p3 = strtolower($request->question_trois);
        // $p4 = strtolower($request->question_quatre);
        $points = $request->points;
        // $bonne_reponse = strtolower($request->bonne_reponse);

        $total_points_allouer = Question::where('formation_id',$fascicule_id)
                                            ->whereNotIn('id', [$question_id])
                                            ->sum('nombre_de_points');

        // dd($total_points_allouer, (int)$points);

        $fascicule = Formation::find($fascicule_id);
        $question = Question::find($question_id);


        if((int)$total_points_allouer == (int)$fascicule->nombre_de_points){
            $_SESSION['message'] = array(
                'type'=>'warning',
                'title'=>'Echec!',
                'message'=>'Vous avez atteint le Nombre total des points prévus pour ce fascicule!!'
            );
        
            return view('pages.admin.question.update', ['question'=>$question, 'fascicule'=>Formation::find($question->formation_id)]);      
        }
        else if((int)$total_points_allouer + (int)$points > $fascicule->nombre_de_points){
            $_SESSION['message'] = array(
                'type'=>'error',
                'title'=>'Echec!',
                'message'=>'Le nombre de points restant pour atteindre le total de points prévus pour ce fascicule est : '.(int)$fascicule->nombre_de_points - (int)$total_points_allouer.' points !'
            );
        
            return view('pages.admin.question.update', ['question'=>$question, 'fascicule'=>Formation::find($question->formation_id)]);

        }
        else{

            $translationIntitule = [];
            // $translationQuestionUne = [];
            // $translationQuestionDeux = [];
            // $translationQuestionTrois = [];
            // $translationQuestionQuatre = [];
            // $translationBonneReponse = [];




            $languages = ['fr', 'en'];


            foreach ($languages as $language) {
                $translate = new GoogleTranslate($language);
                $translatedIntitule = $translate->translate($intitule);
                // $translatedQuestionUne = $translate->translate($p1);
                // $translatedQuestionDeux = $translate->translate($p2);
                // $translatedQuestionTrois = $translate->translate($p3);
                // $translatedQuestionQuatre = $translate->translate($p4);
                // $translatedBonneReponse = $translate->translate($bonne_reponse);
        
                $translationIntitule[$language] = $translatedIntitule;
                // $translationQuestionUne[$language] = $translatedQuestionUne;
                // $translationQuestionDeux[$language] = $translatedQuestionDeux;
                // $translationQuestionTrois[$language] = $translatedQuestionTrois;
                // $translationQuestionQuatre[$language] = $translatedQuestionQuatre;
                // $translationBonneReponse[$language] = $translatedBonneReponse;
                
                try {
        
                    $question->formation_id = $fascicule_id;
                    $question->type = 1;
                    $question->setTranslations('intitule', $translationIntitule);
                    $question->nombre_de_points = $points;
                    // $question->setTranslations('question_une', $translationQuestionUne);
                    // $question->setTranslations('question_deux', $translationQuestionDeux);
                    // $question->setTranslations('question_trois', $translationQuestionTrois);
                    // $question->setTranslations('question_quatre', $translationQuestionQuatre);
                    // $question->setTranslations('bonne_reponse', $translationBonneReponse);
                    $question->generateSlug();
                    $question->save();
        
                
                  } catch (\Exception $e) {
                    //dd($e);
                    return redirect()->back();
        
                  }
        
        
            }
    
            $_SESSION['message'] = array(
                'type'=>'success',
                'title'=>'Réussite!',
                'message'=>'Question modifiée avec succès!!'
            );
        
            return redirect()->route('question_index', $fascicule->slug);
    


        }


    }

}
