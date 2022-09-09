<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renovation extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference',
        'label',
        'district',
        'status',
        'year',
        'month',
        'purpose',
        'cost',
        'estimated_quantity',
        'unit_measure_quantity',
        'is_prime_eligible',
        'estimate_prime',
        'agencyName',
        'agencyAddress',
        'agencyPostalCode',
        'arrondissement_id',
    ];

    public function arrondissement()
    {
        return $this->belongsTo(Arrondissement::class, 'id');
    }
//    public function batiments()
//    {
//        return $this->hasMany(Batiment::class, 'arrondissement_id');
//    }
}
