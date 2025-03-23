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
        $count = DB::table('films')->count();
        $title = "Cantidad de Peliculas";
        return view('films.count', compact('count', 'title'));
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
    
        $modo = env('CREAR_PELICULA', 'DB'); // DB, JSON
    
        if ($modo === 'DB') {
            $exists = DB::table('films')->where('name', $validatedData['name'])->exists();
    
            if ($exists) {
                return redirect()->route('listFilms')->withErrors(['error' => 'Error, la película ya existe en la base de datos.']);
            }
    
            DB::table('films')->insert($validatedData);
            return redirect()->route('listFilms')->with('success', 'Película añadida correctamente en la base de datos.');
        }
    
        if ($modo === 'JSON') {
            $films = Storage::exists('/public/films.json') ? Storage::json('/public/films.json') : [];
    
            foreach ($films as $film) {
                if (strcasecmp($film['name'], $validatedData['name']) === 0) {
                    return redirect()->route('listFilms')->withErrors(['error' => 'Error, la película ya existe en el JSON.']);
                }
            }
    
            $films[] = $validatedData;
            $status = Storage::put('/public/films.json', json_encode($films, JSON_PRETTY_PRINT));
    
            if ($status) {
                return redirect()->route('listFilms')->with('success', 'Película añadida correctamente en el JSON.');
            } else {
                return redirect()->route('listFilms')->withErrors(['error' => 'Error al guardar la película en JSON.']);
            }
        }
    
        return redirect()->route('listFilms')->withErrors(['error' => 'Modo de guardado no válido.']);
    }
    

}