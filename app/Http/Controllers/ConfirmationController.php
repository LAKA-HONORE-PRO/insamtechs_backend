<?php

namespace App\Http\Controllers;

use App\Models\Confirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ConfirmationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $r1 = $request->checkbox1;
        $r2 = $request->checkbox2;
        $r3 = $request->checkbox3;
        $video_id = $request->idvideo;
        $observation = $request->observation;
        $formation_id = $request->formation_id;


        $translationR1 = [];
        $translationR2 = [];
        $translationR3 = [];
        $translationObservation = [];


        $languages = ['fr', 'en'];


        $confirmation_old = Confirmation::where(['user_id'=>Auth::user()->id, 'video_id'=>$video_id])->first();


        if(!$confirmation_old){
            $confirmation = New Confirmation();

            
        foreach ($languages as $language) {
        // $translate = new GoogleTranslate($language);
            $translatedR1 = $r1;
            $translatedR2 = $r2;
            $translatedR3 = $r3;
            $translatedObservation = $observation;


            $translationR1[$language] = $translatedR1;
            $translationR2[$language] = $translatedR2;
            $translationR3[$language] = $translatedR3;
            $translationObservation[$language] = $translatedObservation;
            
            try {


                $confirmation->formation_id = $formation_id;
                $confirmation->user_id = Auth::user()->id;
                $confirmation->video_id = $video_id;
                $confirmation->setTranslations('r1', $translationR1);
                $confirmation->setTranslations('r2', $translationR2);
                $confirmation->setTranslations('r3', $translationR3);
                $confirmation->setTranslations('observation', $translationObservation);
                $confirmation->save();
        

            
            } catch (\Exception $e) {
                return redirect()->back();

            }


        }
    }else{
        return redirect()->back();
    }


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
