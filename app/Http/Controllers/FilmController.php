<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Contracts\View\View;
=======
>>>>>>> 40e166d2b8a87aeea9fb9d4a489979a5f9a86f81
use Illuminate\Support\Facades\Storage;

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
            //foreach ($this->datasource as $film) {
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

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
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
<<<<<<< HEAD
    public function FilmsByYear($year = null)
    {
        $films_filtered = [];
        $films = FilmController::readFilms();
        
        $title = "Listado de todas las películas del año $year";

        foreach ($films as $film) {
            if ($film['year'] == $year) {
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
    public function FilmsByGenre($genre = null)
    {
        $films_filtered = [];
        $films = FilmController::readFilms();
    
        // Validar y asignar un valor predeterminado
        if (is_null($genre)) {
            $genre = 'Drama'; // Cambia por el género que prefieras como predeterminado
        }
    
        // Definir el título antes del bucle
        $title = "Listado de todas las películas del género $genre";
    
        foreach ($films as $film) {
            // Comparar género sin importar mayúsculas/minúsculas
            if (strcasecmp($film['genre'], $genre) == 0) {
                $films_filtered[] = $film;
            }
        }
    
        // Mensaje alternativo si no hay películas
        if (empty($films_filtered)) {
            $title = "No se encontraron películas para el género $genre";
        }
    
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
    
=======
    public function FilmsByYear(): array
    {
        // Obtener las películas usando readFilms
        $films = FilmController::readFilms();

        // Ordenar por año en orden descendente
        usort($films, function ($a, $b) {
            return $b['year'] <=> $a['year'];
        });

        return $films;
    }
    public function FilmsByGenre(): array
    {
        // Obtener las películas usando readFilms
        $films = FilmController::readFilms();

        // Ordenar por género en orden descendente (Z-A)
        usort($films, function ($a, $b) {
            return strcmp($b['genre'], $a['genre']);
        });

        return $films;
    }
    public function CountFilms(): int
    {
        // Obtener las películas usando readFilms
        $films = FilmController::readFilms();

        // Contar las películas
        return count($films);
    }
>>>>>>> 40e166d2b8a87aeea9fb9d4a489979a5f9a86f81
}
