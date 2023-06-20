<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomAuthentification extends Controller
{
    //

    //systeme d'authentification
    public function authentification(Request $request){

        //systeme d'authentification
        $data=$this->validate($request, [
            'email' => 'required',
            'password' => 'required |min:7',          
        ]);

        

        //verifier si l'adresse email existe dans la base de données
        $user = User::where('email',$data['email'])->first();
        if ($user) {  
             //si l'utilisateur a une connexion SQL2
            if ($user->type_connexion=='SQL') {

                //verifier les crédentials de l'utilisateur
                $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials)) {
                    return redirect()->route('home')->with('success',"Bienvenu ".$user->name);
                }
                //en cas de credentials non conforme
                return redirect()->route('login')->with('error','Adresse email ou mot de passe incorrect');
            } else {
            //si l'utilisateur a une connexion Windows
              

             

                $adServer = "ldap://ncbenin.bj";
                $ldap = ldap_connect($adServer);

                if (!$ldap) {
                    $msg = "Impossible de se connecter au serveur AD";
                    return redirect()->route('login')->with('error',$msg);
                 
                }

                $username = extractUsernameFromEmail($data['email']);
                $password = $data['password'];
                $ldaprdn = 'ncbenin' . "\\" . $username;

                ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

                $bind = @ldap_bind($ldap, $ldaprdn, $password);

                if ($bind) {
                    $filter = "(sAMAccountName=$username)";
                    $result = ldap_search($ldap, "dc=NCBENIN,dc=BJ", $filter);

                    if ($result) {
                        $info = ldap_get_entries($ldap, $result);

                        for ($i = 0; $i < $info["count"]; $i++) {
                            if ($info['count'] > 1) {
                                break;
                            }
                            
                        }

                        
                        Auth::login($user);
                        return redirect()->route('home')->with('success',"Bienvenu ".$user->name);
                    } else {
                        $msg = "Recherche LDAP échouée";
                        return redirect()->route('login')->with('error',$msg);
                    }

                    @ldap_close($ldap);
                } else {
                    $msg = "Nom d'utilisateur ou mot de passe invalide";
                    return redirect()->route('login')->with('error',$msg);
                }


            }

         
        } else {
            return back()->with('error',"Adresse email ou mot de passe incorrect");
        }
   

    }


    //systeme de déconnexion
    public function logout(){
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }


}
