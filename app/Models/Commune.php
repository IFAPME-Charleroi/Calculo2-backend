<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_arrondissement',
        'nis',
        'commune',
        'cp'
    ];

    public function arrondissement()
    {
        return $this->belongsTo('App\Models\Arrondissement', 'id_arrondissement');
    }
}
