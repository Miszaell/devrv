<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\materia;

class MateriaController extends Controller
{
    public function list(){
        $materias=materia::all();
        $arr = [
            "res" => "ok",
            "materias" => $materias

        ];
        return $arr;
    }

    public function find(Request $req){
        $materia=materia::find($req->id);
        return $materia;
    }
    public function save(Request $req){
        if($req->id == 0){
            $materia = new materia();
        }
        else{
            $materia =materia::find($req->id);
        }

        if(intval($req->id_brand) != 0){
            $materia->id_brand = intval($req->id_brand);
        }

        $materia->nombre = $req->nombre;
        $materia->horas_semana = $req->horas_semana;


        $materia->save();

        return $materia;
    }

    public function delete($id){
        $materia = materia::find(intval($id));

        $materia->delete();

        return "OK";
    }
}
