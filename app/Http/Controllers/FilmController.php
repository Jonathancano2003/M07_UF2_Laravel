<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{


    public static function readFilms(): array
    {
        $films = Storage::json('/public/films.json');
        return $films;
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
        $title = "Listado de todas las pelis";

        if (is_null($year) && is_null($genre)) {
            return view('films.list', ["films" => $films, "title" => $title]);
        }

        $films_filtered = array_filter($films, function ($film) use ($year, $genre) {
            return (is_null($year) || $film['year'] == $year) &&
                (is_null($genre) || strtolower($film['genre']) == strtolower($genre));
        });

        if ($year && !$genre) {
            $title = "Listado de todas las pelis filtrado por año";
        } elseif (!$year && $genre) {
            $title = "Listado de todas las pelis filtrado por género";
        } elseif ($year && $genre) {
            $title = "Listado de todas las pelis filtrado por género y año";
        }

        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }



    public function FilmsByYear()
    {
        $films = self::readFilms();

        usort($films, fn($a, $b) => $b['year'] <=> $a['year']);

        $title = "Películas ordenadas por año";

        return view('films.list', ["films" => $films, "title" => $title]);
    }



    public function FilmsByGenre()
    {
        $films = self::readFilms();

        usort($films, fn($a, $b) => strcmp($a['genre'], $b['genre']));

        $title = "Películas ordenadas por género";

        return view('films.list', ["films" => $films, "title" => $title]);
    }



    public function CountFilms()
    {
        $films = self::readFilms();
        $count = count($films);

        echo "<h1>Total de películas disponibles</h1>";
        echo "<p>Hay un total de <strong>$count</strong> películas en la base de datos.</p>";
    }


    public function isFilm(Request $request)
    {
        $films = self::readFilms();
        $name = $request->input('name');
        $exists = false;

        foreach ($films as $film) {
            if (strtolower($film['name']) === strtolower($name)) {
                $exists = true;
                break;
            }
        }

        echo "<h1>Verificación de película</h1>";
        echo $exists ? "<p>La película <strong>$name</strong> está en la base de datos.</p>" :
            "<p><strong>$name</strong> no se encuentra en la base de datos.</p>";
    }



    public function createFilm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer|min:1800|max:' . date('Y'),
            'genre' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'img_url' => 'nullable|url',
        ]);

        $films = self::readFilms();

        foreach ($films as $film) {
            if (strtolower($film['name']) === strtolower($validatedData['name'])) {
                return redirect()->route('listFilms')->withErrors(['error' => 'Error, la película ya existe.']);
            }
        }

        $films[] = $validatedData;
        $status = Storage::put('/public/films.json', json_encode($films, JSON_PRETTY_PRINT));

        if ($status) {
            return redirect()->route('listFilms')->with('success', 'Película añadida correctamente.');
        } else {
            return redirect()->route('listFilms')->withErrors(['error' => 'Error al guardar la película.']);
        }
    }
}