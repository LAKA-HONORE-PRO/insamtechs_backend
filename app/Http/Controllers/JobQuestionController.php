<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Formation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stichoza\GoogleTranslate\GoogleTranslate;

class JobQuestionController extends Controller
{
  
    public function question_create(string $slug)
    {
        $fascicule = Formation::where('slug', '=', $slug)->first();

        return view('pages.admin.questionJob.create', ['fascicule'=>$fascicule]);
    }


    public function question_create_one(string $slug)
    {
        $fascicule = Formation::where('slug', '=', $slug)->first();

        return view('pages.admin.questionJob.oneQuestionCreate', ['fascicule'=>$fascicule]);
    }



    public function question_store(Request $request)
    {
        //dd($request);
        $fascicule_id = $request->fascicule_id;
        $intitule1 = strtolower($request->intitule1);
        $intitule2 = strtolower($request->intitule2);
        $intitule3 = strtolower($request->intitule3);
        $intitule4 = strtolower($request->intitule4);
        $intitule5 = strtolower($request->intitule5);


        $points1 = $request->points1;
        $points2 = $request->points2;
        $points3 = $request->points3;
        $points4 = $request->points4;
        $points5 = $request->points5;

        $total_points = (int)$points1 + (int)$points2 +(int)$points3 +(int)$points4 +(int)$points5;


        $total_points_allouer = Question::where(['formation_id'=>$fascicule_id])->sum('nombre_de_points');

        // dd($total_points_allouer, (int)$points);

        $fascicule = Formation::find($fascicule_id);

        // dd($total_points_allouer);

        if((int)$total_points_allouer == (int)$fascicule->nombre_de_points){
            $_SESSION['message'] = array(
                'type'=>'warning',
                'title'=>'Echec!',
                'message'=>'Vous avez atteint le Nombre total des points prévus pour ce job!!'
            );
        
            return redirect()->route('create_questionjob', $fascicule->slug);
        }
        else if((int)$total_points_allouer + (int)$total_points > $fascicule->nombre_de_points){
            $_SESSION['message'] = array(
                'type'=>'error',
                'title'=>'Echec!',
                'message'=>'Le nombre de points restant pour atteindre le total de points prévus pour ce job est : '.(int)$fascicule->nombre_de_points - (int)$total_points_allouer.' points !'
            );
        
            return redirect()->route('create_questionjob', $fascicule->slug);  
        }
        else{

            $translationIntitule1 = [];
            $translationIntitule2 = [];
            $translationIntitule3 = [];
            $translationIntitule4 = [];
            $translationIntitule5 = [];




            $languages = ['fr', 'en'];


            foreach ($languages as $language) {
                $translate = new GoogleTranslate($language);
                $translatedIntitule1 = $translate->translate($intitule1);
                $translatedIntitule2 = $translate->translate($intitule2);
                $translatedIntitule3 = $translate->translate($intitule3);
                $translatedIntitule4 = $translate->translate($intitule4);
                $translatedIntitule5 = $translate->translate($intitule5);
               
               
               
                $translationIntitule1[$language] = $translatedIntitule1;
                $translationIntitule2[$language] = $translatedIntitule2;
                $translationIntitule3[$language] = $translatedIntitule3;
                $translationIntitule4[$language] = $translatedIntitule4;
                $translationIntitule5[$language] = $translatedIntitule5;
            }
    
            try {

                $take = Question::where(['formation_id'=>$fascicule_id, 'intitule'=>$intitule1])->first();
                
                    if($take == null)
                    {


                    $question = New Question();
                    $question->formation_id = $fascicule_id;
                    $question->type = 2;
                    $question->setTranslations('intitule', $translationIntitule1);
                    $question->nombre_de_points = $points1;
                    $question->generateSlug();
                    $question->save();

    
                    $question = New Question();
                    $question->formation_id = $fascicule_id;
                    $question->type = 2;
                    $question->setTranslations('intitule', $translationIntitule2);
                    $question->nombre_de_points = $points2;
                    $question->generateSlug();
                    $question->save();
         
                    $question = New Question();
                    $question->formation_id = $fascicule_id;
                    $question->type = 2;
                    $question->setTranslations('intitule', $translationIntitule3);
                    $question->nombre_de_points = $points3;
                    $question->generateSlug();
                    $question->save();
        

                    $question = New Question();
                    $question->formation_id = $fascicule_id;
                    $question->type = 2;
                    $question->setTranslations('intitule', $translationIntitule4);
                    $question->nombre_de_points = $points4;
                    $question->generateSlug();
                    $question->save();


                    $question = New Question();
                    $question->formation_id = $fascicule_id;
                    $question->type = 2;
                    $question->setTranslations('intitule', $translationIntitule5);
                    $question->nombre_de_points = $points5;
                    $question->generateSlug();
                    $question->save();
                }
                else{
                    
                }
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
                    dd($e);
                    return redirect()->back();
        
                  }




            $_SESSION['message'] = array(
                'type'=>'success',
                'title'=>'Réussite!',
                'message'=>'Question ajoutée avec succès!!'
            );
        
            return redirect()->route('questionjob_index', $fascicule->slug);
    


        }
        
    }





    public function question_store_one(Request $request)
    {
        //dd($request);
        $fascicule_id = $request->fascicule_id;
        $intitule1 = strtolower($request->intitule1);


        $points1 = $request->points1;


        $total_points = (int)$points1;


        $total_points_allouer = Question::where(['formation_id'=>$fascicule_id])->sum('nombre_de_points');

        // dd($total_points_allouer, (int)$points);

        $fascicule = Formation::find($fascicule_id);

        // dd($total_points_allouer);

        if((int)$total_points_allouer == (int)$fascicule->nombre_de_points){
            $_SESSION['message'] = array(
                'type'=>'warning',
                'title'=>'Echec!',
                'message'=>'Vous avez atteint le Nombre total des points prévus pour ce job!!'
            );
        
            return redirect()->route('createone_questionjob', $fascicule->slug);
        }
        else if((int)$total_points_allouer + (int)$total_points > $fascicule->nombre_de_points){
            $_SESSION['message'] = array(
                'type'=>'error',
                'title'=>'Echec!',
                'message'=>'Le nombre de points restant pour atteindre le total de points prévus pour ce job est : '.(int)$fascicule->nombre_de_points - (int)$total_points_allouer.' points !'
            );
        
            return redirect()->route('createone_questionjob', $fascicule->slug);  
        }
        else{

            $translationIntitule1 = [];




            $languages = ['fr', 'en'];


            foreach ($languages as $language) {
                $translate = new GoogleTranslate($language);
                $translatedIntitule1 = $translate->translate($intitule1);
               
                $translationIntitule1[$language] = $translatedIntitule1;

            }
    
            try {

                 $take = Question::where(['formation_id'=>$fascicule_id, 'intitule'=>$intitule1])->first();
                
                    if($take == null)
                    {


                    $question = New Question();
                    $question->formation_id = $fascicule_id;
                    $question->type = 2;
                    $question->setTranslations('intitule', $translationIntitule1);
                    $question->nombre_de_points = $points1;
                    $question->generateSlug();
                    $question->save();

                }
                else{
                    
                }

                
                  } catch (\Exception $e) {
                    dd($e);
                    return redirect()->back();
        
                  }




            $_SESSION['message'] = array(
                'type'=>'success',
                'title'=>'Réussite!',
                'message'=>'Question ajoutée avec succès!!'
            );
        
            return redirect()->route('questionjob_index', $fascicule->slug);
    


        }
        
    }










    public function question_index(string $slug){
        $fascicule = Formation::where(['slug'=>$slug])->first();
       return view('pages.admin.questionJob.index', ['questions'=>Question::where(['formation_id'=>$fascicule->id])->get(), 'fascicule'=>$fascicule]);
    }


    public function question_edit(string $id)
    {
        $question = Question::find($id);
        return view('pages.admin.questionJob.update', ['question'=>$question, 'fascicule'=>Formation::find($question->formation_id)]);
    }


    public function question_update(Request $request)
    {

        $fascicule_id =$request->fascicule_id;
        $question_id = $request->question_id;

        $intitule = strtolower($request->intitule);
        $points = $request->points;

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
                'message'=>'Vous avez atteint le Nombre total des points prévus pour ce job!!'
            );
        
            return view('pages.admin.questionJob.update', ['question'=>$question, 'fascicule'=>Formation::find($question->formation_id)]);      
        }
        else if((int)$total_points_allouer + (int)$points > $fascicule->nombre_de_points){
            $_SESSION['message'] = array(
                'type'=>'error',
                'title'=>'Echec!',
                'message'=>'Le nombre de points restant pour atteindre le total de points prévus pour ce job est : '.(int)$fascicule->nombre_de_points - (int)$total_points_allouer.' points !'
            );
        
            return view('pages.admin.questionJob.update', ['question'=>$question, 'fascicule'=>Formation::find($question->formation_id)]);

        }
        else{

            $translationIntitule = [];





            $languages = ['fr', 'en'];


            foreach ($languages as $language) {
                $translate = new GoogleTranslate($language);
                $translatedIntitule = $translate->translate($intitule);
        
                $translationIntitule[$language] = $translatedIntitule;
     
                
                try {
        
                    $question->formation_id = $fascicule_id;
                    $question->setTranslations('intitule', $translationIntitule);
                    $question->nombre_de_points = $points;
                    $question->generateSlug();
                    $question->save();
        
                
                  } catch (\Exception $e) {
                    return redirect()->back();
        
                  }
        
        
            }
    
            $_SESSION['message'] = array(
                'type'=>'success',
                'title'=>'Réussite!',
                'message'=>'Question modifiée avec succès!!'
            );
        
            return redirect()->route('questionjob_index', $fascicule->slug);
    


        }


    }



    public function question_delete(Request $request)
    {
        $question = Question::find($request->id);
        
        $question->delete();

        $_SESSION['message'] = array(
            'type'=>'success',
            'title'=>'Réussite!',
            'message'=>'Question supprimée avec succès!!'
        );

        return redirect()->back();
    
    }
}
