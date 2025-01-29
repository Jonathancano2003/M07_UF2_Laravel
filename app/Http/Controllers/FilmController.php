<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array
    {
        $films = Storage::json('/public/films.json');
        return $films;
    }
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {
        $old_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {

            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();


        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);


        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            } else if ((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)) {
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            } else if (!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
    public function FilmsByYear(): array
    {

        $films = FilmController::readFilms();


        usort($films, function ($a, $b) {
            return $b['year'] <=> $a['year'];
        });

        return $films;
    }
    public function FilmsByGenre(): array
    {
        $films = FilmController::readFilms();

        usort($films, function ($a, $b) {
            return strcmp($b['genre'], $a['genre']);
        });

        return $films;
    }
    public function CountFilms(): int
    {
        $films = FilmController::readFilms();

        return count($films);
    }
    public function isFilm(array $films, string $name): bool
    {
        foreach ($films as $film) {
            if (strtolower($film['name']) === strtolower($name)) {
                return true;
            }
        }
        return false;
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

        if ($this->isFilm($films, $validatedData['name'])) {
            return redirect()->back()->with('status', 'Error, la película ya existe.');
        }

        $films[] = $validatedData;

        $status = Storage::put('/public/films.json', json_encode($films, JSON_PRETTY_PRINT));

        if ($status) {
            return redirect()->route('listFilms')->with('status', 'Película añadida correctamente.');
        } else {
            return redirect()->back()->with('status', 'Error al guardar la película.');
        }
    }
}
