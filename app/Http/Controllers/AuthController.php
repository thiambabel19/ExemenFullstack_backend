<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //liste des users
    public function getAllUsers(){
        return response()->json(User::all(), 200);
    }

    //Retourner un user
    public function getUserById($id){

        $user = User::find($id);

        if(is_null($user)){
            return response()->json(['message' => 'Utilisateur introuvable'], 404);
        }else{
            return response()->json(User::find($id), 200);
        }
    }

    //Supprimer un user
    public function deleteUser($id){

        $user = User::find($id);

        if(is_null($user)){
            return response()->json(['message' => 'Utilisateur introuvable'], 404);
        }
        else
        {
            $user->delete();
            return response(200);
        }

    }

    //rechercher un utiilisateur
    public function searchUser($name){

        $user = User::where('name', 'like', '%'.$name.'%')->get();

        if(is_null($user)){
            return response()->json(['message' => 'Utilisateur introuvable'], 404);
        }else{
            return $user;
        }
    }
    
    //ajout user
    public function register(Request $request){

        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    // user login
    public function login(Request $request){

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //verifiction adresse email
        $user = User::where('email', $fields['email'])->first();

        //verifiction password
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Mot de passe incorrect ... '
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    //deconnexion
    public function logout(Request $request){
        //auth()->user()->acces_tokens()->delete();
        $request->user()->currentAccessToken()->delete();
        return [
            'message' => 'Vous êtes déconnectés ...'
        ];
    }

     //mise à jour d'un profil
    public function updateUser(Request $request, $id){

        $user = User::find($id);

        if(is_null($user)){
            return response()->json(['message' => 'Utilisateur introuvable'], 404);
        }
        else
        {
            $user->update($request->all());
            return response($user, 200);
        }

    }

    public function getUser(Request $request){
        return $request->user();
    }

    protected function redirectTo($request){

        if(! $request->expectsJson()){
            return route('user/login');
        }

    }
}