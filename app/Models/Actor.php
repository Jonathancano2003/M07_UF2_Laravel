<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $table = 'actors';

    protected $fillable = [
        'name',
        'surname',
        'birthdate',
        'country',
        'img_url'
    ];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'films_actors');
    }
}
