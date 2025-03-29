<?php

namespace App\Http\Controllers;

use App\Models\Composer;
use App\Models\Question;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExamenJobController extends Controller
{
    
     /**
     * Display a listing of the resource.
     */
    public function index(string $slug)
    {

        $fascicule = Formation::where('slug', $slug)->first();

        // $question = Question::where('formation_id', $fascicule->id)->first(); // Récupérer la première question depuis la base de données
    
        return view('pages.ExamenJob', ['fascicule'=>$fascicule]);
    }


    public function take(string $id){
        $locale = app()->getLocale();
        
        $questions = Question::where('formation_id', $id)->get();

        return response()->json(['questions'=>$questions, 'locale'=>$locale]);
    }



    public function note(string $id){
        $user = Auth::user();

        $questions = Question::where('formation_id', $id)->get();
        $questions_points = Question::where('formation_id', $id)->sum('nombre_de_points');
        $composers = Composer::where(['user_id'=>$user->id, 'formation_id'=>$id])->get();
        $fascicule = Formation::find($id);
        $points = 0;
        $pt = 0;

            foreach($questions as $question)
            {
               $composer = Composer::where(['user_id'=>$user->id, 'formation_id'=>$id, 'question_id'=>$question->id])->first();
               if($composer){
                    if($composer->reponse == 'Pas du tout' || $composer->reponse == 'No way'){
                        $points = (int)$points + (int)0;
                    }
                    elseif($composer->reponse == 'Partiellement' || $composer->reponse == 'Partially'){
                        $points = round((float)$points + (float)($question->nombre_de_points / 3), 2);
                    }
                    elseif($composer->reponse == 'Parfaitement' || $composer->reponse == 'Perfectly'){
                        $points = round((float)$points + (float)($question->nombre_de_points / 2), 2);
                    }
                    elseif($composer->reponse == 'Totalement' || $composer->reponse == 'Totally'){
                        $points = (int)$points + (int)$question->nombre_de_points;
                    }
               }
            }

        return response()->json(['note'=>$points, 'total'=>$questions_points]);
    }



    public function getNextQuestion(Request $request)
    {
        $reponse = request('reponse_choisie');
        $formation = request('fascicule_id');
        $question_id = request('question_id');
        $user = Auth::user();
        $date = date('d . m . Y');

        $composer = new Composer();



            $reponses_enregistrees = Composer::where(['user_id'=>$user->id, 'formation_id'=>$formation, 'date'=>$date])->get();
            $nombre = Question::where('formation_id', $formation)->get();

                $composer->user_id = $user->id;
                $composer->formation_id = $formation;
                $composer->question_id = $question_id;
                $composer->reponse = $reponse;
                $composer->date = $date;

        if(sizeof($reponses_enregistrees) >= sizeof($nombre)){
            return response()->json(['success' => false]);
        }
        else{
            $composer->save();
        }

    
        return response()->json(['success' => true]);
    }



    public function resultat(string $slug)
    {
        $user = Auth::user();
        $points = 0;

        $fascicule = Formation::where(['slug'=>$slug])->first();

        // dd($slug);

        $questions = Question::where('formation_id', $fascicule->id)->get();
        $reponses = Composer::where(['user_id'=>$user->id, 'formation_id'=>$fascicule->id])->get();

        
        foreach($questions as $question)
            {
               $composer = Composer::where(['user_id'=>$user->id, 'formation_id'=>$fascicule->id, 'question_id'=>$question->id])->first();
               if($composer){
                if($composer->reponse == 'Pas du tout' || $composer->reponse == 'No way'){
                    $points = (int)$points + (int)0;
                }
                elseif($composer->reponse == 'Partiellement' || $composer->reponse == 'Partially'){
                    $points = round((float)$points + (float)($question->nombre_de_points / 3), 2);
                }
                elseif($composer->reponse == 'Parfaitement' || $composer->reponse == 'Perfectly'){
                    $points = round((float)$points + (float)($question->nombre_de_points / 2), 2);
                }
                elseif($composer->reponse == 'Totalement' || $composer->reponse == 'Totally'){
                    $points = (int)$points + (int)$question->nombre_de_points;
                }
               }
            }

        // dd($points);
        return view('pages.ResultatJob', ['questions'=>$questions, 'reponses'=>$reponses, 'fascicule'=>$fascicule, 'points'=>$points]);

    }


        public function delete(string $slug)
        {
             $user = Auth::user();
             $fascicule = Formation::where(['slug'=>$slug])->first();


            $composer = Composer::where(['user_id'=>$user->id, 'formation_id'=>$fascicule->id])->get();

             if(sizeof($composer) > 0){
            //     foreach($composer as $item)
            //     {
                    DB::table('composers')
                    ->where('user_id', $user->id)
                    ->where('formation_id', $fascicule->id)
                    ->delete();
            //         }
             }

        return response()->json(['success' => true]);

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
    public function show(string $id)
    {
        //
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
