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
    public function listActorsByDecade(Request $request)
    {
        $year = $request->input('year');

        if (is_null($year)) {

            $actors = collect();
            $title = "Selecciona una década para ver actores";
        } else {
            $startYear = floor($year / 10) * 10;
            $endYear = $startYear + 9;

            $actors = DB::table('actors')
                ->whereBetween(DB::raw('YEAR(birthdate)'), [$startYear, $endYear])
                ->get();

            $title = "Actores nacidos entre $startYear y $endYear";
        }

        return view('actors.list', compact('actors', 'title', 'year'));
    }

    public function destroy($id)
    {
        $status = DB::table('actors')->where('id', $id)->delete();

        return json_encode(['action' => 'delete', 'status' => $status ? true : false]);
    }
}
