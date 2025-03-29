<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ComposerFasciculePDF;
use App\Models\Formation;
use App\Http\Controllers\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ComposerFasciculeController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $booklet_id = $request->booklet_id;
        $user_id = $request->user_id;
        $booklet_link = $request->file('booklet_file');
        $file_link = '';

        if($booklet_link->getClientOriginalExtension() != "pdf"){
            $_SESSION['message'] = array(
                'type'=>'error',
                'title'=>'Echec!',
                'message'=>'Le fichier doit être au format PDF!!'
            );
            
            return redirect()->back();
        }

        $user = User::findOrFail($user_id);
        $booklet = Formation::where('id', $booklet_id)->first();
        //Traitement de l'image

        $nomDossier = "Evaluation_Fascicule/".$booklet->intitule;
        $nomFichier = Str::slug($user->nom.'-'.$user->prenom.'-'.$booklet->intitule.'-'.$booklet_link->getClientOriginalExtension()); //Génération du nom du fichier à partir du nom, prénom et id de l'utilisateur.
        $file_link = Storage::disk('public')->putFileAs($nomDossier, $booklet_link, $nomFichier);

        $composer_old = ComposerFasciculePDF::where(["user_id"=>$user_id, "formation_id"=>$booklet_id])->first();

if(!$composer_old){

    try{

        $composer = new ComposerFasciculePDF();


        if($booklet->etat === 1){
            $composer->formation_id = $booklet_id;
            $composer->user_id = $user->id;
            $composer->booklet_link = $file_link;

            $composer->save();
        }else{
            $_SESSION['message'] = array(
                'type'=>'error',
                'title'=>'Echec!',
                'message'=>'Vous ne pouvez pas soumettre votre épreuve car le temps qui lui a été attribué a été passé. Veuillez vous rapprocher des administrateurs en cas de requête!'
            );

            return redirect()->back();
        }


    }catch(\Exception $e){
        $_SESSION['message'] = array(
            'type'=>'error',
            'title'=>'Echec!',
            'message'=>'Une erreur est survenue, veuillez rééssayer!!'
        );

        return redirect()->back();
    }
                
    $_SESSION['message'] = array(
        'type'=>'success',
        'title'=>'Réussite!',
        'message'=>'Votre document a été sousmis avec succès!!'
    );

}else{
    $_SESSION['message'] = array(
        'type'=>'warning',
        'title'=>'Echec!',
        'message'=>'Vous avez déjà soumis un document similaire!!'
    );  
}



    return redirect()->back();
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
