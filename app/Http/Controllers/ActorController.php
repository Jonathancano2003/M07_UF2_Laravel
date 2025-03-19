<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
    public function listActors()
    {
        $actors = DB::table('actors')->get();
        $title = "Listado de Actores";
        return view('actors.list', compact('actors', 'title'));
    }
    public function countActors()
    {
        $count = DB::table('actors')->count();
        $title = "Cantidad de Actores";
        return view('actors.count', compact('count', 'title'));
    }
}
