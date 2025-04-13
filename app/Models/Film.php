<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    // Asegúrate de incluir los campos que pueden ser asignados en masa
    protected $fillable = ['name', 'year', 'genre', 'country', 'duration', 'img_url'];

    // Relación muchos a muchos con actores
    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'films_actors');
    }
}
