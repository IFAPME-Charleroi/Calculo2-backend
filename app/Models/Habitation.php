<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'type',
        'market_value',
        'province',
        'construct_year',
        'environment',
        'transport',
        'zone'
    ];
}
