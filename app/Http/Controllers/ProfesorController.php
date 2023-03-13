<?php

namespace App\Http\Controllers;

use App\Models\profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfesorController extends Controller
{
    function list() {
        $profesors = DB::table('profesors')
            ->leftjoin('materias', 'profesors.id_materia', '=', 'materias.id')
            ->select('profesors.*', 'materias.nombre as nombre_materia')
            ->orderBy('profesors.updated_at', 'desc')
            ->get();
        return $profesors;
    }

    public function find(Request $req)
    {
        $profesor = profesor::find($req->id);
        return $profesor;
    }
    public function save(Request $req)
    {
        if ($req->id == 0) {
            $profesor = new profesor();
        } else {
            $profesor = profesor::find($req->id);
        }

        if (intval($req->id_materia) != 0) {
            $profesor->id_materia = intval($req->id_materia);
        }

        $profesor->nombre = $req->nombre;
        $profesor->grado_estudio = $req->grado_estudio;
        $profesor->id_materia = $req->id_materia;

        $profesor->save();

        return $profesor;
    }

    public function delete($id)
    {
        $profesor = DB::table('profesors')->where('id', intval($id))->delete();
        $resp = array([
            "id" => 0,
            "nombre" => "",
            "grado_estudio" => "",
            "id_materia" => 0,
        ]);
        $status = $profesor == 1 ? 200 : 500;
        return response()->json($resp, $status);

    }
}
