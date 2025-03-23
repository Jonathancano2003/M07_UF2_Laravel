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
    public function listActorsByDecade($year = null)
{
    if (is_null($year)) {
        return redirect()->route('listActorsByDecade', ['year' => 2000]); // Año por defecto
    }

    $startYear = floor($year / 10) * 10;
    $endYear = $startYear + 9;

    $actors = DB::table('actors')
        ->whereBetween(DB::raw('YEAR(birthdate)'), [$startYear, $endYear])
        ->get();

    $title = "Actores nacidos entre $startYear y $endYear";
    return view('actors.list', compact('actors', 'title', 'year'));
}

public function destroy($id)
{
    $status = DB::table('actors')->where('id', $id)->delete();

return json_encode(['action' => 'delete', 'status' => $status ? true : false]);


}
public function showFilms($id)
{
    $actor = DB::table('actors')->where('id', $id)->first();
    
    if (!$actor) {
        return response()->json(['error' => 'Actor no encontrado'], 404);
    }

    $films = DB::table('films')
        ->join('films_actors', 'films.id', '=', 'films_actors.film_id')
        ->where('films_actors.actor_id', $id)
        ->select('films.*') 
        ->get();

    return response()->json([
        'actor' => $actor->name,
        'films' => $films
    ]);
}


}