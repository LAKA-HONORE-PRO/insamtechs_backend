<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Http\Request;

class BrancheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.branche.index', ['branches'=>Branche::orderBy('id', 'desc')->simplePaginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('pages.admin.branche.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $intitule = strtolower($request->input('intitule'));
        $date = date('d.m.Y');

        $translationIntitule = [];


        $languages = ['fr', 'en'];

        // dd($request);
        $branche = new Branche();


      foreach ($languages as $language) {
        $translate = new GoogleTranslate($language);
        $translatedIntitule = $translate->translate($intitule);

        $translationIntitule[$language] = $translatedIntitule;
        
        try {


            $branche->setTranslations('intitule', $translationIntitule);
            $branche->generateSlug();
            $branche->save();
    

        
          } catch (\Exception $e) {
            return redirect()->back();

          }

        }


        $_SESSION['message'] = array(
            'type'=>'success',
            'title'=>'Réussite!',
            'message'=>'Filière ajoutée avec succès!!'
        );
    
        return redirect()->route('branche.index');
    
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
        return view('pages.admin.branche.update', ['branche'=>Branche::where('slug', $slug)->first()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $intitule = strtolower($request->input('intitule'));

        $translationIntitule = [];

        $domaine = Branche::find($id);


        $languages = ['fr', 'en'];
  

        
      foreach ($languages as $language) {
        $translate = new GoogleTranslate($language);
        $translatedIntitule = $translate->translate($intitule);

        $translationIntitule[$language] = $translatedIntitule;
        
        try {


            $domaine->setTranslations('intitule', $translationIntitule);
            $domaine->generateSlug();
            $domaine->save();

          } catch (\Exception $e) {
            return redirect()->back();

          }
        }


        $_SESSION['message'] = array(
            'type'=>'success',
            'title'=>'Réussite!',
            'message'=>'Filière modifiée avec succès!!'
        );
    
        return redirect()->route('branche.index');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
