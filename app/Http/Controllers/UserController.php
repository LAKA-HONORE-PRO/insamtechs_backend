<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Formation;
use App\Models\Attestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.user.index', ['users'=>User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $email = $request->email;
        $password = Hash::make($request->password);
        $role = $request->role;
        $droits = 4;

        $user = New User();
  
            $user->email=$email;
            $user->password=$password;
            $user->role=$role;
            $user->droits = $droits;

            $user->save();


            $_SESSION['message'] = array(
                'type'=>'success',
                'title'=>'Réussite!',
                'message'=>'Utilisateur ajouté avec succès!!'
            );
        
            return redirect()->route('user.index');

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
        return view('pages.admin.user.update', ['user'=>User::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;
        $password_modify = '';
        $droits = 4;


        if($password == '')
        {
            $password_modify = $user->password;
        }
        else{
            $password_modify = Hash::make($password);
        }


        User::find($id)->update([
            'email'=>$email,
            'password'=>$password_modify,
            'role'=>$role,
            'droits'=>$droits,

        ]);

        $_SESSION['message'] = array(
            'type'=>'success',
            'title'=>'Réussite!',
            'message'=>'Utilisateur modifé avec succès!!'
        );
    
        return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    public function update_profil(Request $request){

        $user = User::find(Auth::user()->id);

        $nom = strtolower($request->nom);
        $prenom = strtolower($request->prenom);
        $nationalite = strtolower($request->nationalite);
        $phone = $request->phone;
        $email = strtolower($request->email);


        User::find($user->id)->update([
            'nom'=>$nom,
            'prenom'=>$prenom,
            'tel'=>$phone,
            'nationalite'=>$nationalite,
            'email'=>$email,
        ]);

        
        return redirect()->back()->withErrors([
            'profil'=>'Votre profil a été mit à jour avec succès !',
        ]);
    }

    public function update_profil_for_attestation(Request $request){

        $user = User::find(Auth::user()->id);
        $formation = Formation::find($request->formation_id);
        $nom = strtolower($request->nom);
        $prenom = strtolower($request->prenom);

        $certificate_number = rand('100', '999').$user->id.'-INSAM-'.date('Y');

        User::find($user->id)->update([
            'nom'=>$nom,
            'prenom'=>$prenom,
        ]);

        $old_attestation = Attestation::where(['user_id'=>$user->id, 'formation_id'=>$formation->id])->first();

        if(!$old_attestation){
            $attestation = new Attestation();

            $attestation->formation_id = $formation->id;
            $attestation->user_id = $user->id;
            $attestation->certificate_number = $certificate_number;
            $attestation->save();
    
        }
        return redirect()->route('getAttestation', $formation->slug);

    }

    

    public function update_password(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $old_password = $request->password_actuel;


        if(password_verify($old_password, $user->password))
        {

            User::find($user->id)->update([
                'password'=>Hash::make($request->new_password)
            ]);

            return redirect()->back()->withErrors([
                'profil'=>'Votre mot de passe a été mit à jour avec succès !',
            ]);
        }
        else{
            return redirect()->back()->withErrors([
                'profil'=>'Ancien mot de passe incorrecte !',
            ]);
        }

    }
}
