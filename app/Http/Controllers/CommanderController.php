<?php

namespace App\Http\Controllers;

use App\Models\Commander;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommanderController extends Controller
{
   

    public function commande_create(string $slug)
    {
            $formation = Formation::where('slug', $slug)->first();
            $user = Auth::user();
            $date = date('d.m.Y');


            $commande = Commander::where(['user_id'=>$user->id, 'formation_id'=>$formation->id])->first();


            if($commande == null)
            {
                $commander = New Commander();

                $commander->user_id = $user->id;
                $commander->formation_id = $formation->id;
                $commander->etat_commande = 0;
                $commander->date = $date;
                $commander->generateSlug();
                $commander->save();

                $_SESSION['message'] = array(
                    'type'=>'success',
                    'message'=>'Vous avez ajouté un produit à votre panier!!'
                );
            }
            else{

            }

            return redirect()->route('panier');

    }


    public function commande_delete(string $slug)
    {
        $commande = Commander::where('slug', $slug)->first();

        Commander::destroy($commande->id);

        return redirect()->route('panier');
        
    }



}
