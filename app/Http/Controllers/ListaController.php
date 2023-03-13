<?php

namespace App\Http\Controllers;

use App\Models\lista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListaController extends Controller
{
    function list() {
        $listas = DB::table('listas')
            ->leftjoin('materias', 'listas.id_materia', '=', 'materias.id')
            ->leftjoin('alumnos', 'listas.id_alumno', '=', 'alumnos.id')
            ->select('listas.*', 'materias.nombre as nombre_materia', 'alumnos.nombre as alumno')
            ->orderBy('listas.updated_at', 'desc')
            ->get();
        return $listas;
    }

    public function listByMateria($id)
    {
        $listas = DB::table('alumnos')
            ->leftjoin('materias', 'alumnos.id_materia', '=', 'materias.id')
            ->select('alumnos.id as id_alumno', 'materias.id as id_materia', 'materias.nombre as materia', 'alumnos.nombre as alumno')
            ->where('id_materia', intval($id))
            ->get();
        return $listas;

    }

    public function find(Request $req)
    {
        $lista = lista::find($req->id);
        return $lista;
    }
    public function save(Request $req)
    {
        if ($req->id == 0) {
            $lista = new lista();
        } else {
            $lista = lista::find($req->id);
        }

        $lista->id_alumno = $req->id_alumno;
        $lista->id_materia = $req->id_materia;
        $lista->asistencia = $req->asistencia;
        $lista->fecha = now();

        $lista->save();

        return $lista;
    }

    public function delete($id)
    {
        $lista = lista::find(intval($id));

        $lista->delete();

        return "OK";
    }
}
