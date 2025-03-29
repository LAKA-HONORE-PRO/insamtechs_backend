<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }


    public function doLogin(LoginRequest $request)
    {

        // dd($request);
        $credentials = $request->validated();

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            if(Auth::user()->role == 'admin'){
                return redirect()->intended(route('dashboard'));
            }
            else{
                
                $_SESSION['bienvenue'] = array(
                    'icon'=>'success',
                    'message'=>'Vous êtes connecté!!'
                );
                
                return redirect()->intended(route('accueil'));
                
            }
        }
        else{
            return redirect()->back()->withErrors([
                'email'=>'Numéro de téléphone ou mot de passe incorrect!',
            ])->onlyInput('tel_1');
        }
        // Auth::login();

        return view('auth.login');
    }


        public function doInscription(Request $request)
        {
            $nom = strtolower($request->nom);
            $prenom = strtolower($request->prenom);
            $tel = $request->tel;
            $password = Hash::make($request->password_ins);
            $role = 'user';
            $droits = 4;


            $check = User::where(['tel_1'=>$tel])->first();

            if($check){
                $_SESSION['bienvenue'] = array(
                    'icon'=>'warning',
                    'message'=>'Un compte a déjà été créé avec ce numéro de téléphone!!'
                );
                
                return redirect()->back();
            }

            $user = New User();

            $user->nom = $nom;
            $user->prenom = $prenom;
            $user->tel_1 = $tel;
            $user->password = $password;
            $user->role = $role;
            $user->droits = $droits;

            $user->save();

            // $request = [
            //     'email' => $email,
            //     'password' => $password,
            // ];


            Auth::login($user);
                            
                $_SESSION['bienvenue'] = array(
                    'icon'=>'success',
                    'message'=>'Vous êtes connecté!!'
                );
                
                
            return redirect()->intended(route('accueil'));

        }




    public function logout(){
        Auth::logout();

        $_SESSION['bienvenue'] = array(
            'icon'=>'success',
            'message'=>'Vous êtes déconnecté!!'
        );
    
        return to_route('accueil');
    }
}
