<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\ListaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:api')->group(function () {

Route::get('alumno/list', [AlumnoController::class, 'list']);
Route::get('alumno/find', [AlumnoController::class, 'find']);
Route::post('alumno/save', [AlumnoController::class, 'save']);
Route::delete('alumno/delete/{id}', [AlumnoController::class, 'delete']);

Route::get('materia/list', [MateriaController::class, 'list']);
Route::get('materia/find', [MateriaController::class, 'find']);
Route::post('materia/save', [MateriaController::class, 'save']);
Route::delete('materia/delete/{id}', [MateriaController::class, 'delete']);

Route::get('profesor/list', [ProfesorController::class, 'list']);
Route::get('profesor/find', [ProfesorController::class, 'find']);
Route::post('profesor/save', [ProfesorController::class, 'save']);
Route::delete('profesor/delete/{id}', [ProfesorController::class, 'delete']);

Route::get('lista/list', [ListaController::class, 'list']);
Route::get('lista/listByMateria', [ListaController::class, 'listByMateria']);
Route::get('lista/find', [ListaController::class, 'find']);
Route::post('lista/save', [ListaController::class, 'save']);
Route::post('lista/delete', [ListaController::class, 'delete']);
});
