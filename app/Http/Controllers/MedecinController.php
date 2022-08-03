<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    //liste des medecins
    public function getAllMedecins(){
        return response()->json(Medecin::all(), 200);
    }

    //Retourner un medecin
    public function getMedecinById($id){

        $medecin = Medecin::find($id);

        if(is_null($medecin)){
            return response()->json(['message' => 'medecin introuvable'], 404);
        }else{
            return response()->json(Medecin::find($id), 200);
        }
    }

    //ajouter un medecin
    public function addMedecin(Request $request){
        $medecin = Medecin::create($request->all());
        return response($medecin, 200);
    }

    //mise à jour d'un medecin
    public function updateMedecin(Request $request, $id){

        $medecin = Medecin::find($id);

        if(is_null($medecin)){
            return response()->json(['message' => 'medecin introuvable'], 404);
        }
        else
        {
            $medecin->update($request->all());
            return response($medecin, 200);
        }

    }

    //Supprimer un medecin
    public function deleteMedecin($id){

        $medecin = Medecin::find($id);

        if(is_null($medecin)){
            return response()->json(['message' => 'medecin introuvable'], 404);
        }
        else
        {
            $medecin->delete();
            return response(200);
        }

    }

    //rechercher un medecin
    public function searchMedecin($prenom){

        $m = Medecin::where('prenom', 'like', '%'.$prenom.'%')->get();

        if(is_null($m)){
            return response()->json(['message' => 'medecin introuvable'], 404);
        }else{
            return $m;
        }
    }

}