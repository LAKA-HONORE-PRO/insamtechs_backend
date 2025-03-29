<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Formation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class BibliothequeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.bibliotheque.index', ['bibliotheques'=>Formation::where('type_formation_id', '=', 2)->simplePaginate(100)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.bibliotheque.create', ['categories'=>Categorie::where('type', 2)->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $categorie_id = $request->categorie;
        $intitule = strtolower($request->input('intitule'));
        $langue = strtolower($request->input('langue'));
        $prix = $request->input('prix');
        $description = $request->input('description');
        $acces = $request->acces;
        $file = $request->fichier;
        $date = date('d.m.Y');



        // $nomDossier = 'Livres';

        // $nomSlug = Str::slug($intitule); // Génère le slug à partir du nom d'origine
        // $nomFichier = $nomSlug . rand(1, 1000);


        // $file = Storage::disk('public')->putFileAs($nomDossier, $fichier, $nomFichier);


        $translationIntitule = [];
        $translationDescription = [];
        $translationPrix = [];
        $translationLangue = [];

        $languages = ['fr', 'en'];

        $bibliotheque = new Formation();



        foreach ($languages as $language) {
           // $translate = new GoogleTranslate($language);
           // $translatedIntitule = $translate->translate($intitule);
           // $translatedDescription = $translate->translate($description);
           // $translatedPrix = $translate->translate($prix);
           // $translatedLangue = $translate->translate($langue);
    
            $translationIntitule[$language] = $intitule;
            $translationDescription[$language] = $description;
            $translationPrix[$language] = $prix;
            $translationLangue[$language] = $langue;
            
            try {
    
                $bibliotheque->categorie_id = $categorie_id;
                $bibliotheque->type_formation_id = 2;
                $bibliotheque->setTranslations('intitule', $translationIntitule);
                $bibliotheque->setTranslations('description', $translationDescription);
                $bibliotheque->setTranslations('langue_formation', $translationLangue);
                $bibliotheque->setTranslations('prix', $translationPrix);
                $bibliotheque->lien = $file;
                $bibliotheque->date = $date;
                $bibliotheque->generateSlug();
                $bibliotheque->telechargeable = $acces;

                // dd($fascicule);
                $bibliotheque->save();
        
    
            
              } catch (\Exception $e) {
                return redirect()->back();
    
              }

              

    }


    
    
    $_SESSION['message'] = array(
        'type'=>'success',
        'title'=>'Réussite!',
        'message'=>'Fascicule ajouté avec succès!!'
    );

    return redirect()->route('bibliotheques.index');


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
       return view('pages.admin.bibliotheque.update', ['bibliotheque'=>Formation::where(['slug'=>$slug])->first(), 'categories'=>Categorie::where('type', 2)->get()]);
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categorie_id = $request->categorie;
        $categorie_id = $request->categorie;
        $intitule = strtolower($request->input('intitule'));
        $langue = strtolower($request->input('langue'));
        $prix = $request->input('prix');
        $description = strtolower($request->description);
        $acces = $request->acces;

        $file = $request->fichier;
        $date = date('d.m.Y');

        $bibliotheque = Formation::find($id);


        $translationIntitule = [];
        $translationDescription = [];
        $translationPrix = [];
        $translationLangue = [];

        $languages = ['fr', 'en'];





        
        $languages = ['fr', 'en'];


        foreach ($languages as $language) {
           // $translate = new GoogleTranslate($language);
           // $translatedIntitule = $translate->translate($intitule);
           // $translatedDescription = $translate->translate($description);
           // $translatedPrix = $translate->translate($prix);
           // $translatedLangue = $translate->translate($langue);
    
            $translationIntitule[$language] = $intitule;
            $translationDescription[$language] = $description;
            $translationPrix[$language] = $prix;
            $translationLangue[$language] = $langue;
            
            try {
    
                $bibliotheque->categorie_id = $categorie_id;
                $bibliotheque->type_formation_id = 2;
                $bibliotheque->setTranslations('intitule', $translationIntitule);
                $bibliotheque->setTranslations('description', $translationDescription);
                $bibliotheque->setTranslations('langue_formation', $translationLangue);
                $bibliotheque->setTranslations('prix', $translationPrix);
                $bibliotheque->lien = $fichier!=''?$file:$bibliotheque->lien;
                $bibliotheque->date = $date;
                $bibliotheque->generateSlug();
                $bibliotheque->telechargeable = $acces;

                $bibliotheque->save();
        
        
    
            
              } catch (\Exception $e) {
                dd($e);
                return redirect()->back();
    
              }
    

    }

    
    $_SESSION['message'] = array(
        'type'=>'success',
        'title'=>'Réussite!',
        'message'=>'Livre modifié avec succès!!'
    );

    return redirect()->route('bibliotheques.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    public function telechargerfichier($slug)
    {

        $livre = Formation::where('slug', $slug)->first();
        $url = $livre->lien;
        // $filename = basename($url);
        // file_put_contents($filename, file_get_contents($url));
        $filename = basename($url);
        $file = file_get_contents($url);
        
        // Spécifiez l'en-tête pour le téléchargement
        header('Content-Description: File Transfer');
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($file));
        
        return redirect($filename);


    }
    
    
    /* public function telechargerLivre($slug)
    {
        $livre = Formation::where('slug', $slug)->first();
        $url = $livre->lien;
        $nomFichier = $livre->slug;

        $options = [
            'http' => [
                'timeout' => 60, // Augmente le délai d'attente à 60 secondes
            ],
        ];
        $context = stream_context_create($options);
        $fileContent = file_get_contents($url, false, $context);

        if ($fileContent !== false) {
            return response($fileContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $nomFichier . '"');
        } else {
            abort(404, 'Le fichier demandé est introuvable.');
        }
    }*/
    

        
    public function telechargerLivre($slug)
    {
        $livre = Formation::where('slug', $slug)->first();
        $url = $livre->lien;
        $nomFichier = ucfirst($livre->intitule) . '.pdf'; // Ajout de l'extension .pdf
    
        $client = new Client();
    
        try {
            $response = $client->get($url, [
                'timeout' => 60, // Augmente le délai d'attente à 60 secondes
            ]);
    
            $fileContent = $response->getBody()->getContents();
    
            return response($fileContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $nomFichier . '"');
        } catch (RequestException $e) {
            abort(404, 'Le fichier demandé est introuvable.');
        }
    }
    
    
    
}
