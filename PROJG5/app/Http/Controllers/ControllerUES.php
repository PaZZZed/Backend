<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\UE;

class ControllerUES extends Controller
{
    public function getAll(){
    	$ue = UE::paginate(25);
    	return view('ue',['ues' => $ue]);
    }

    public function insertUE(Request $request){
        $idUe = UE::find($request->UE);
        try {
            if($idUe==null){
                $newUe = new UE;
                $newUe->UE = $request->UE;
                $newUe->ECTS = $request ->ECTS;
                $newUe->heures = $request->heures;
                $newUe->save();
                return back()->withSuccess('UE ajoutée avec succès.');
            }
            else{
                $newUe = UE::find($request->UE);
                $newUe->UE = $request->UE;
                $newUe->ECTS = $request ->ECTS;
                $newUe->heures = $request->heures;
                $newUe->save();
                return back()->withSuccess('UE mise à jour avec succès.');
            }
        }
        catch (\Exception $exception){
            return back()->withError('Erreur : données invalides.');
        }
    }

    public function deleteUE($id){
        try {
            $ue = UE::destroy($id);
            return back()->withSuccess('UE supprimée avec succès.');
        }
        catch (\Exception $exception){
            return back()->withError("Impossible de supprimer l'UE : elle est en cours d'utilisation (bulletin/PAE). ");
        }
    }
}
