<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.faq.index', ['faqs'=>Faq::simplePaginate(20)]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('pages.admin.faq.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $intitule = strtolower($request->input('intitule'));
        $reponse = strtolower($request->input('reponse'));
        $lien = $request->input('lien');

        $translationIntitule = [];
        $translationReponse = [];


        $languages = ['fr', 'en'];


        $faq = new Faq();


      foreach ($languages as $language) {
        $translate = new GoogleTranslate($language);
        $translatedIntitule = $translate->translate($intitule);
        $translatedReponse = $translate->translate($reponse);

        $translationIntitule[$language] = $translatedIntitule;
        $translationReponse[$language] = $translatedReponse;
        
        try {


            $faq->setTranslations('intitule', $translationIntitule);
            $faq->setTranslations('reponse', $translationReponse);
            $faq->lien = $lien;
            $faq->save();
        
          } catch (\Exception $e) {
            return redirect()->back();
          }


    }


    

    $_SESSION['message'] = array(
        'type'=>'success',
        'title'=>'Réussite!',
        'message'=>'Faq ajoutée avec succès!!'
    );

    return redirect()->route('faq.index');


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
        return view('pages.admin.faq.update', ['faq'=>Faq::find($id)]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $intitule = strtolower($request->input('intitule'));
        $reponse = strtolower($request->input('reponse'));
        $lien =$request->input('lien');

        $translationIntitule = [];
        $translationReponse = [];


        $languages = ['fr', 'en'];


        $faq = Faq::find($id);


      foreach ($languages as $language) {
        $translate = new GoogleTranslate($language);
        $translatedIntitule = $translate->translate($intitule);
        $translatedReponse = $translate->translate($reponse);

        $translationIntitule[$language] = $translatedIntitule;
        $translationReponse[$language] = $translatedReponse;
        
        try {


            $faq->setTranslations('intitule', $translationIntitule);
            $faq->setTranslations('reponse', $translationReponse);
            $faq->lien = $lien;
            $faq->save();
        
          } catch (\Exception $e) {
            return redirect()->back();
          }


    }


    

    $_SESSION['message'] = array(
        'type'=>'success',
        'title'=>'Réussite!',
        'message'=>'Faq modifiée avec succès!!'
    );

    return redirect()->route('faq.index');

}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = Faq::find($id);

        dd($faq);
        Faq::destroy($id);

        $_SESSION['message'] = array(
            'type'=>'success',
            'title'=>'Réussite!',
            'message'=>'Faq supprimée avec succès!!'
        );
    
        return redirect()->route('faq.index');
    
    }
}
