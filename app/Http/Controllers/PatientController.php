<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //liste des medecins
    public function getAllPatients(){
        return response()->json(Patient::all(), 200);
    }

    //Retourner un patient
    public function getPatientById($id){

        $patient = Patient::find($id);

        if(is_null($patient)){
            return response()->json(['message' => 'patient introuvable'], 404);
        }else{
            return response()->json(Patient::find($id), 200);
        }
    }

    //ajouter un patient
    public function addPatient(Request $request){
        $patient = Patient::create($request->all());
        return response($patient, 200);
    }

    //mise à jour d'un patient
    public function updatePatient(Request $request, $id){

        $patient = Patient::find($id);

        if(is_null($patient)){
            return response()->json(['message' => 'patient introuvable'], 404);
        }
        else
        {
            $patient->update($request->all());
            return response($patient, 200);
        }

    }

    //Supprimer un patient
    public function deletePatient($id){

        $patient = Patient::find($id);

        if(is_null($patient)){
            return response()->json(['message' => 'patient introuvable'], 404);
        }
        else
        {
            $patient->delete();
            return response(200);
        }

    }

    //rechercher un patient
    public function searchPatient($prenom){

        $m = Patient::where('prenom', 'like', '%'.$prenom.'%')->get();

        if(is_null($m)){
            return response()->json(['message' => 'patient introuvable'], 404);
        }else{
            return $m;
        }
    }
}
