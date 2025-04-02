<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
    public function listActors()
    {
        $actors = Actor::all();
        $title = "Listado de Actores";
        return view('actors.list', compact('actors', 'title'));
    }

    public function countActors()
    {
        $count = Actor::count();
        $title = "Cantidad de Actores";
        return view('actors.count', compact('count', 'title'));
    }

    public function listActorsByDecade(Request $request)
    {
        $year = $request->input('year');

        if (is_null($year)) {
            $actors = collect();
            $title = "Selecciona una década para ver actores";
        } else {
            $startYear = floor($year / 10) * 10;
            $endYear = $startYear + 9;

            $actors = Actor::whereBetween(
                DB::raw('YEAR(birthdate)'), 
                [$startYear, $endYear]
            )->get();

            $title = "Actores nacidos entre $startYear y $endYear";
        }

        return view('actors.list', compact('actors', 'title', 'year'));
    }

    public function destroy($id)
    {
        $actor = Actor::find($id);

        if (!$actor) {
            return response()->json(['error' => 'Actor no encontrado'], 404);
        }

        $actor->delete();

        return response()->json(['action' => 'delete', 'status' => true]);
    }

    public function showFilms($id)
    {
        $actor = Actor::with('films')->find($id);

        if (!$actor) {
            return response()->json(['error' => 'Actor no encontrado'], 404);
        }

        return response()->json([
            'actor' => $actor->name,
            'films' => $actor->films
        ]);
    }
}
