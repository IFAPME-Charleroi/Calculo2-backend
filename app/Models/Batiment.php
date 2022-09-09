<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batiment extends Model
{
    use HasFactory;

    protected $fillable = [
        'arrondissement_id',
        'year',
        'buildings',
    ];

//    public function renovation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(Renovation::class, 'arrondissement_id');
//    }
}
