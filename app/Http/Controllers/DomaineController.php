<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\Http\Request;
use App\Imports\domainesImport;
use App\Models\Branche;
use Maatwebsite\Excel\Facades\Excel;
use Stichoza\GoogleTranslate\GoogleTranslate;

class DomaineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.domaine.index', ['domaines'=>Domaine::orderBy('id', 'desc')->simplePaginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branche::orderBy('intitule', 'ASC')->get();
        return view ('pages.admin.domaine.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $intitule = strtolower($request->input('intitule'));
        $branche_id = $request->branche_id;
        $date = date('d.m.Y');

        $translationIntitule = [];


        $languages = ['fr', 'en'];

        // dd($request);
        $domaine = new Domaine();


      foreach ($languages as $language) {
        $translate = new GoogleTranslate($language);
        $translatedIntitule = $translate->translate($intitule);

        $translationIntitule[$language] = $translatedIntitule;
        
        try {

            $domaine->branche_id = $branche_id;
            $domaine->setTranslations('intitule', $translationIntitule);
            $domaine->date = $date;
            $domaine->generateSlug();
            $domaine->save();
    

        
          } catch (\Exception $e) {
            return redirect()->back();

          }


    }


    

    $_SESSION['message'] = array(
        'type'=>'success',
        'title'=>'Réussite!',
        'message'=>'Série ajoutée avec succès!!'
    );

    return redirect()->route('domaine.index');

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
      $branches = Branche::orderBy('intitule', 'ASC')->get();
      $domaine = Domaine::where('slug', $slug)->first();
        return view('pages.admin.domaine.update', compact('domaine', 'branches'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $branche_id = $request->branche_id;
        $intitule = strtolower($request->input('intitule'));
        $type = $request->input('type');

        $date = date('d.m.Y');
        
        $translationIntitule = [];

        $domaine = Domaine::find($id);


        $languages = ['fr', 'en'];
  

        
      foreach ($languages as $language) {
        $translate = new GoogleTranslate($language);
        $translatedIntitule = $translate->translate($intitule);

        $translationIntitule[$language] = $translatedIntitule;
        
        try {

            $domaine->branche_id = $branche_id;
            $domaine->setTranslations('intitule', $translationIntitule);
            $domaine->date = $date;
            $domaine->generateSlug();
            $domaine->save();

          } catch (\Exception $e) {
            return redirect()->back();

          }

    }


    $_SESSION['message'] = array(
        'type'=>'success',
        'title'=>'Réussite!',
        'message'=>'Série modifiée avec succès!!'
    );

    return redirect()->route('domaine.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      //
    }
}
