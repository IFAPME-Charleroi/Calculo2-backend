<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculo2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'renovation_id',
        'year',
        'kwh_before',
        'kwh_after',
        'kwh_eco',
        'co2_before',
        'co2_after',
        'co2_eco',
        'm2',
        'kwh_m2',
        'co2_m2',
    ];
}
