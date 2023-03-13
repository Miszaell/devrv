<?php

namespace App\Http\Controllers;

use App\Models\materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriaController extends Controller
{
    function list() {
        $materias = materia::all();
        return $materias;
    }

    public function find(Request $req)
    {
        $materia = materia::find($req->id);
        return $materia;
    }
    public function save(Request $req)
    {
        if ($req->id == 0) {
            $materia = new materia();
        } else {
            $materia = materia::find($req->id);
        }

        if (intval($req->id_brand) != 0) {
            $materia->id_brand = intval($req->id_brand);
        }

        $materia->nombre = $req->nombre;
        $materia->horas_semana = $req->horas_semana;

        $materia->save();

        return $materia;
    }

    public function delete($id)
    {
        $materia = DB::table('materias')->where('id', intval($id))->delete();
        $resp = array([
            "id" => 0,
            "nombre" => "",
            "horas_semana" => "",
        ]);
        $status = $materia == 1 ? 200 : 500;
        return response()->json($resp, $status);

    }
}
