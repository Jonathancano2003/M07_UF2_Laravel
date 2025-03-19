<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public static function readFilms(): array
    {
        $filmsFromJson = Storage::exists('/public/films.json') 
            ? Storage::json('/public/films.json') 
            : [];

        $filmsFromDB = DB::table('films')->get()->map(function ($film) {
            return (array) $film;
        })->toArray();

        return array_merge($filmsFromJson, $filmsFromDB);
    }

    public function listOldFilms($year = null)
    {
        if (is_null($year)) {
            $year = 2000;
        }

        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $films = self::readFilms();
        $old_films = array_filter($films, fn($film) => $film['year'] < $year);

        return view('films.list', ["films" => $old_films, "title" => $title]);
    }

    public function listNewFilms($year = null)
    {
        if (is_null($year)) {
            $year = 2000;
        }

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = self::readFilms();
        $new_films = array_filter($films, fn($film) => $film['year'] >= $year);

        return view('films.list', ["films" => $new_films, "title" => $title]);
    }

    public function listFilms($year = null, $genre = null)
    {
        $films = self::readFilms();

        if ($year || $genre) {
            $films = array_filter($films, function ($film) use ($year, $genre) {
                return (is_null($year) || $film['year'] == $year) &&
                       (is_null($genre) || strcasecmp($film['genre'], $genre) == 0);
            });
        }

        $title = "Listado de todas las películas";
        return view('films.list', compact('films', 'title'));
    }

    public function filmsByYear()
    {
        $films = self::readFilms();
        usort($films, fn($a, $b) => $b['year'] <=> $a['year']);
        $title = "Películas ordenadas por año";
        return view('films.list', ["films" => $films, "title" => $title]);
    }

    public function filmsByGenre()
    {
        $films = self::readFilms();
        usort($films, fn($a, $b) => strcmp($a['genre'], $b['genre']));
        $title = "Películas ordenadas por género";
        return view('films.list', ["films" => $films, "title" => $title]);
    }

    public function countFilms()
    {
        $films = self::readFilms();
        $count = count($films);
        return view('films.count', compact('count'));
    }

    public function isFilm(Request $request)
    {
        $films = self::readFilms();
        $name = $request->input('name');
        $exists = false;

        foreach ($films as $film) {
            if (strcasecmp($film['name'], $name) === 0) {
                $exists = true;
                break;
            }
        }

        return view('films.exists', compact('name', 'exists'));
    }

    public function createFilm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer|min:1800|max:' . date('Y'),
            'genre' => 'required|string|max:50',
            'country' => 'required|string|max:30',
            'duration' => 'required|integer|min:1',
            'img_url' => 'nullable|url|max:255',
        ]);
    
        $existsInDB = DB::table('films')->where('name', $validatedData['name'])->exists();
        if ($existsInDB) {
            return redirect()->route('listFilms')->withErrors(['error' => 'Error, la película ya existe en la base de datos.']);
        }
    
        DB::table('films')->insert($validatedData);
    
        return redirect()->route('listFilms')->with('success', 'Película añadida correctamente en la base de datos.');
    }
}