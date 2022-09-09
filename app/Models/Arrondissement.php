<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrondissement extends Model
{
    use HasFactory;

    protected $fillable = [
        'ins',
        'entite',
        'latitude',
        'longitude',
        'geojson',
        'shapeLength',
        'shapeArea',
        'totBuild2016',
        'totBuild2017',
        'totBuild2018',
        'totBuild2019',
        'totBuild2020',
        'totBuild2021'
    ];

    public function communes()
    {
        return $this->hasMany(Commune::class, 'id_arrondissement');
    }
    public function renovations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Renovation::class, 'arrondissement_id');
    }
}
