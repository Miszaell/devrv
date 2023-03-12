<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\profesor;

class ProfesorController extends Controller
{
    public function list(){
        $profesors=DB::table('profesors')
        ->leftjoin('materias', 'profesors.id_materia', '=','materias.id')
        ->select('profesors.*','materias.nombre as nombre_,ateria')
        ->orderBy('profesors.updated_at','desc')
        ->get();
        return $profesors;
    }

    public function find(Request $req){
        $profesor=profesor::find($req->id);
        return $profesor;
    }
    public function save(Request $req){
        if($req->id == 0){
            $profesor = new profesor();
        }
        else{
            $profesor =profesor::find($req->id);
        }

        if(intval($req->id_brand) != 0){
            $profesor->id_brand = intval($req->id_brand);
        }

        $profesor->nombre = $req->nombre;
        $profesor->grado_estudio = $req->grado_estudio;
        $profesor->id_materia = $req->id_materia;


        $profesor->save();

        return $profesor;
    }

    public function delete($id){
        $profesor = profesor::find($id);

        $profesor->delete();

        return "OK";
    }
}
