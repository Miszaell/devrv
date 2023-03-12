<?php

namespace App\Http\Controllers;

use App\Models\alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    public function list(){
        $alumnos=DB::table('alumnos')
        ->leftjoin('materias', 'alumnos.id_materia', '=','materias.id')
        ->select('alumnos.*','materias.nombre as nombre_materia')
        ->orderBy('alumnos.updated_at','desc')
        ->get();
        return $alumnos;
    }

    public function find(Request $req){

        $alumno=alumno::find($req["id"]);
        return $alumno;
    }
    public function save(Request $req){
        if($req["id"] == 0){
            $alumno = new alumno();
        }
        else{
            $alumno =alumno::find($req["id"]);
        }

        if(intval($req["id_materia"]) != 0){
            $alumno->id_materia = intval($req["id_materia"]);
        }

        $alumno->nombre = $req["nombre"];
        $alumno->edad = intval($req["edad"]);
        $alumno->matricula = $req["matricula"];
        $alumno->id_materia = intval($req["id_materia"]);

        $alumno->save();

        return $alumno;
    }

    public function delete($id){
        $alumno = DB::table('alumnos')->where('id',intval($id))->delete();
        $resp = array([
            "id" => 0,
            "nombre" => "",
            "edad" => 0,
            "matricula" => "",
            "id_materia" => 0
        ]);
        $status = $alumno == 1 ? 200 : 500;
        return response()->json($resp, $status);
    }
}
