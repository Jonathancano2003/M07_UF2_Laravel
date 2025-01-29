<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateUrl
{
    /**
     * Manejar la solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el campo 'img_url' está presente
        if ($request->has('img_url')) {
            $url = $request->input('img_url');

            // Validar si es una URL válida
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                return response()->view('welcome', ['status' => 'Error, URL de imagen no es correcta']);
            }
        }

        // Continuar si no hay problemas
        return $next($request);
    }
}
