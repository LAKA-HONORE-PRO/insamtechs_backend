<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
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
        $nom = $request->nom;
        $email = $request->email;
        $objet = $request->objet;
        $message = $request->message;
        $type = 1;


        $newsletter = New Newsletter();

        $newsletter->nom = $nom;
        $newsletter->email = $email;
        $newsletter->objet = $objet;
        $newsletter->message = $message;
        $newsletter->type = $type;

        $newsletter->save();

        return redirect()->back()->withErrors([
            'email'=>'Votre message a été enregistré avec succès !',
        ]);
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

    public function newsletter_form(Request $request)
    {
        $email = $request->email;

        $take = Newsletter::where(['email'=>$email, 'type'=>2])->first();

        if($take)
        {

        }
        else{
            $newsletter = New Newsletter();


            $newsletter->email = $email;
            $newsletter->type = 2;
    
            $newsletter->save();
    
            $_SESSION['bienvenue'] = array(
                'icon'=>'success',
                'message'=>'Vous avez souscrit avec succès à notre NewsLetter!'
            );
    
            return to_route('accueil');

        }
        


    }
}
