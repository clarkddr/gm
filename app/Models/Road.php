<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Road extends Model
{
    /** @use HasFactory<\Database\Factories\RoadFactory> */
    use HasFactory;

    public function toll(){
        return $this->belongsTo(Toll::class);
    }

    public function routes (){
        return $this->belongsToMany(Route::class);
    }
}
