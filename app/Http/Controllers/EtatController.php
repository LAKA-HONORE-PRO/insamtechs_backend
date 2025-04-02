<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Formation;
use Illuminate\Http\Request;

class EtatController extends Controller
{
    public function index(Request $request){
        $formations = Formation::where('categorie_id', $request->categorie_id)->get();

        return view('pages.admin.etat.VideoParCategorieListe', ['formations'=>$formations, 'categorie'=>Categorie::find($request->categorie_id)]);
    }


    public function indexForm(Request $request){
        $formations = Formation::where('categorie_id', $request->categorie_id)->get();

        return view('pages.admin.etat.listeFormationsVideosParCategorie', ['formations'=>$formations, 'categorie'=>Categorie::find($request->categorie_id)]);
    }


    public function fasciculescategorie(Request $request){
        $formations = Formation::where(['categorie_id'=>$request->categorie_id])->get();

        return view('pages.admin.etat.FasciculesParCategorieListe', ['formations'=>$formations, 'categorie'=>Categorie::find($request->categorie_id)]);
    }

    

    public function jobscategorie(Request $request)
    {
        $jobs = Formation::where(['categorie_id'=>$request->categorie_id, 'etat'=>1])->get();

        return view('pages.admin.etat.JobParCategorieListe', ['jobs'=>$jobs, 'categorie'=>Categorie::find($request->categorie_id)]);
    }

    public function etatGlobalLivres(Request $request){
        $categories = '';
        $livres = '';
        if($request->categorie_id == 'tout'){
            $categories = Categorie::where('type', 2)->get();
             return view('pages.admin.etat.ListeEtatGlobalLivres', ['categories'=>$categories]);
        }else{
            $livres = Formation::where(['categorie_id'=>$request->categorie_id, 'etat'=>1])->get();
            return view('pages.admin.etat.ListeEtatGlobalLivres', ['livres'=>$livres, 'categorie'=>Categorie::find($request->categorie_id)]);
        }
    }

    
    public function ajax_type_document(Request $request)
    {
        $val = $request->val;

        if($val == 0){
             ?>
                <label for="duree" class="form-label">Lien du fascicule <span style="color: red">*</span></label>
                <input type="text" class="form-control" id="fichier" name="fichier" required>
                <br>
            <?php
        }
        else if($val == 1){
            ?>
              <label for="duree" class="form-label">Téléverser un fichier <span style="color: red">*</span></label>
                <input type="file" class="form-control" id="fichier" name="fichier" accept=".pdf" required>
                <br>
            <?php
        }
        else{
            
        }
    }



    public function fichier_input(Request $request)
    {
        $val = $request->val;

        if($val == 1){
             ?>
                <label for="duree" class="form-label"> Image illustrative <span style="color: red">*</span></label>
                <input type="file" class="form-control" id="fichier" name="fichier" accept=".pdf,.jpg,.png" required>
                <br>
            <?php
        }
      /*  else if($val == 1){
            ?>
              <label for="duree" class="form-label">Téléverser un fichier <span style="color: red">*</span></label>
                <input type="file" class="form-control" id="fichier" name="fichier" accept=".pdf,.jpg,.png" required>
                <br>
            <?php
        }
    */
        else{
            
        }
    }



}
