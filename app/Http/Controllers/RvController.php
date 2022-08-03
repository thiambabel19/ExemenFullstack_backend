<?php

namespace App\Http\Controllers;

use App\Models\Rv;
use Illuminate\Http\Request;

class RvController extends Controller
{
    //liste des rvs
    public function getAllRv(){
        return response()->json(Rv::all(), 200);
    }

    //Retourner un rv
    public function getRvById($id){

        $rv = Rv::find($id);

        if(is_null($rv)){
            return response()->json(['message' => 'rv introuvable'], 404);
        }else{
            return response()->json(Rv::find($id), 200);
        }
    }

    //ajouter un rv
    public function addRv(Request $request){
        $rv = Rv::create($request->all());
        return response($rv, 200);
    }

    //mise à jour d'un rv
    public function updateRv(Request $request, $id){

        $rv = Rv::find($id);

        if(is_null($rv)){
            return response()->json(['message' => 'rv introuvable'], 404);
        }
        else
        {
            $rv->update($request->all());
            return response($rv, 200);
        }

    }

    //Supprimer un rv
    public function deleteRv($id){

        $rv = Rv::find($id);

        if(is_null($rv)){
            return response()->json(['message' => 'rv introuvable'], 404);
        }
        else
        {
            $rv->delete();
            return response(200);
        }

    }

    
}