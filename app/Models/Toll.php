<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toll extends Model
{
    /** @use HasFactory<\Database\Factories\TollFactory> */
    use HasFactory;

    protected $guarded = [];

    public function road(){
        return $this->belongsTo(Road::class);
    }

    public function units(){
        return $this->belongsToMany(Unit::class)->withPivot('price');
    }
}
